let add_hotel_form = document.getElementById('add_hotel_form');
add_hotel_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_hotel();
});
function add_hotel()
{
    let data = new FormData();
    data.append('add_hotel','');
    data.append('name',add_hotel_form.elements['name'].value);
    data.append('place',add_hotel_form.elements['place'].value);
    data.append('desc',add_hotel_form.elements['desc'].value);

    let rooms = [];
    add_hotel_form.elements['rooms'].forEach(el =>{
        if(el.checked){
            rooms.push(el.value);
        }
    });
    data.append('rooms',JSON.stringify(rooms));
   
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('add-hotel');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if(this.responseText == 1){
            alert('success','New Hotel added!');
            add_hotel_form.reset();
            get_all_hotels();
        }
        else{
            alert('error','Server Down!');
        }
    }
    xhr.send(data);
}
function get_all_hotels()
{  
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
       document.getElementById('hotel-data').innerHTML = this.responseText;
    }
    xhr.send('get_all_hotels');
}
let edit_hotel_form = document.getElementById('edit_hotel_form');
function edit_details(id)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
       
        let data = JSON.parse(this.responseText);

        edit_hotel_form.elements['name'].value = data.hoteldata.name;
        edit_hotel_form.elements['place'].value = data.hoteldata.place;
        edit_hotel_form.elements['desc'].value = data.hoteldata.description;
        edit_hotel_form.elements['hotel_id'].value = data.hoteldata.id;

        edit_hotel_form.elements['rooms'].forEach(el =>{
            if(data.rooms.includes(Number(el.value))){
                el.checked = true;
            }
        });
    }
    xhr.send('get_hotel='+id);  
}
edit_hotel_form.addEventListener('submit',function(e){
    e.preventDefault();
    submit_edit_hotel();
});
function submit_edit_hotel()
{
    let data = new FormData();
    data.append('edit_hotel','');
    data.append('hotel_id',edit_hotel_form.elements['hotel_id'].value);
    data.append('name',edit_hotel_form.elements['name'].value);
    data.append('place',edit_hotel_form.elements['place'].value);
    data.append('desc',edit_hotel_form.elements['desc'].value);

    let rooms = [];
    edit_hotel_form.elements['rooms'].forEach(el =>{
        if(el.checked){
            rooms.push(el.value);
        }
    });
  
    data.append('rooms',JSON.stringify(rooms));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);

    xhr.onload = function(){
    var myModal = document.getElementById('edit-hotel');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
        if(this.responseText == 1){
            alert('success','Hotel data edited!');
            edit_hotel_form.reset();
            get_all_hotels();
        }
        else{
            alert('error','Server Down!');
        }
    }
    xhr.send(data);
}
let add_image_form = document.getElementById('add_image_form');
add_image_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_image();
});
function add_image()
{
    let data = new FormData();
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('hotel_id',add_image_form.elements['hotel_id'].value);
    data.append('add_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);

    xhr.onload = function(){
        if(this.responseText == 'inv_img'){
            alert('error','Only JPG, WEBP or PNG images are allowed!','image-alert');
        }
        else if(this.responseText == 'inv_size'){
            alert('error','Image should be less than 2MB!','image-alert');
        }
        else if(this.responseText == 'upd_failed'){
            alert('error','Image upload failed. Server Down!','image-alert');
        }
        else{
            alert('success','New image added!','image-alert');
            hotel_images(add_image_form.elements['hotel_id'].value, document.querySelector("#hotel-images .modal-title").innerText);
            add_image_form.reset();
        }
    }
    xhr.send(data);
}
function hotel_images(id,hname)
{
    document.querySelector("#hotel-images .modal-title").innerText = hname;
    add_image_form.elements['hotel_id'].value = id;
    add_image_form.elements['image'].value = '';
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
       document.getElementById('hotel-image-data').innerHTML = this.responseText;
    }
    xhr.send('get_hotel_images='+id);   
}
function rem_image(img_id,hotel_id)
{
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('hotel_id',hotel_id);
    data.append('rem_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/hotels.php",true);

    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','Image Removed!','image-alert');
            hotel_images(hotel_id,document.querySelector("#hotel-images .modal-title").innerText);
        }
        else{
            alert('error','Image removal failed!','image-alert');
        }
    }
    xhr.send(data);
}
function remove_hotel(hotel_id)
{
    if(confirm("Are you sure, you want to delete this hotel?"))
    {
        let data = new FormData();
        data.append('hotel_id',hotel_id);
        data.append('remove_hotel','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/hotels.php",true);
        
        xhr.onload = function(){
            if(this.responseText == 1){
                alert('success','Hotel Removed!');
                get_all_hotels();
            }
            else{
                alert('error','Hotel removal failed!');
            }
        }
        xhr.send(data);
    }
}
window.onload = function(){
    get_all_hotels();
}

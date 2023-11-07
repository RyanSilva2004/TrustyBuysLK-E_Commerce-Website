let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account-box');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
}

function validateAddProductsForm() {
    var name = document.forms[0]["add_name"].value;
    var price = document.forms[0]["add_price"].value;
    var qty = document.forms[0]["add_qty"].value;
    var image = document.forms[0]["add_image"].files[0];

    // Clear previous error messages
    document.getElementById("add_nameError").innerHTML = "";
    document.getElementById("add_priceError").innerHTML = "";
    document.getElementById("add_qtyError").innerHTML = "";
    document.getElementById("add_imageError").innerHTML = "";

    if (name == "") {
        document.getElementById("add_nameError").innerHTML = "Name field must be filled out";
        return false;
    }
    
    if (price == "") {
        document.getElementById("add_priceError").innerHTML = "Price field must be filled out";
        return false;
    } else if (price <= 0) {
        document.getElementById("add_priceError").innerHTML = "Price must be greater than 0";
        return false;
    }
    
    if (qty == "" || qty <= 0) {
        document.getElementById("add_qtyError").innerHTML = "Quantity must be greater than 0";
        return false;
    }
    
    if (image == undefined || image.size > 5000000) {
        document.getElementById("add_imageError").innerHTML = "Image must be provided and size should be less than 5MB";
        return false;
    }

    return true;
}

function validateEditProductsForm() 
{
    var name = document.querySelector('input[name="update_name"]').value;
    var price = document.querySelector('input[name="update_price"]').value;
    var qty = document.querySelector('input[name="update_qty"]').value;
    var image = document.querySelector('input[name="update_image"]').files[0];
 
    if(name == "") 
    {
       document.getElementById('update_nameError').textContent = "Product name is required.";
       return false;
    } 
    else if(price == "" || price <= 0) 
    {
       document.getElementById('update_priceError').textContent = "Valid product price is required.";
       return false;
    } 
    else if(qty == "" || qty <= 0) 
    {
       document.getElementById('update_qtyError').textContent = "Valid product quantity is required.";
       return false;
    } 
    else if(image && image.size > 5000000) 
    {
       document.getElementById('update_imageError').textContent = "Image file size is too large.";
       return false;
    }

    return true;
 }
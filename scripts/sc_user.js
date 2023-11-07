let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

function validateMessageForm() 
{

   document.getElementById('msg_nameError').textContent = '';
   document.getElementById('msg_emailError').textContent = '';
   document.getElementById('msg_numberError').textContent = '';
   document.getElementById('msg_messageError').textContent = '';

   var msg_name = document.querySelector('input[name=msg_name]').value;
   var msg_email = document.querySelector('input[name=msg_email]').value;
   var msg_number = document.querySelector('input[name=msg_number]').value;
   var msg_message = document.querySelector('textarea[name=msg_message]').value;

   var isValid = true;

   if (!msg_name) {
      document.getElementById('msg_nameError').textContent = 'Name is required.';
      isValid = false;
   }

   if (!msg_email) {
      document.getElementById('msg_emailError').textContent = 'Email is required.';
      isValid = false;
   }

   if (!msg_number) {
      document.getElementById('msg_numberError').textContent = 'Number is required.';
      isValid = false;
   }

   if (!msg_message) {
      document.getElementById('msg_messageError').textContent = 'Message is required.';
      isValid = false;
   }

   return isValid;
}

function validateOrderForm() {
   // Get form fields


   var name = document.forms["order_form"]["order_name"].value;
   var number = document.forms["order_form"]["order_number"].value;
   var email = document.forms["order_form"]["order_email"].value;
   var flat = document.forms["order_form"]["flat"].value;
   var street = document.forms["order_form"]["street"].value;
   var city = document.forms["order_form"]["city"].value;
   var state = document.forms["order_form"]["state"].value;
   var country = document.forms["order_form"]["country"].value;
   var pincode = document.forms["order_form"]["pin_code"].value;

   // Validate name
   if (name == "") {
       document.getElementById("error_name").innerHTML = "Name is required";
       return false;
   }

   // Validate number
   if (number == "") {
       document.getElementById("error_number").innerHTML = "Number is required";
       return false;
   }

   // Validate email
   if (email == "") {
       document.getElementById("error_email").innerHTML = "Email is required";
       return false;
   }

   // Validate address
   if (flat == "" || street == "" || city == "" || state == "" || country == "" || pincode == "") {
       document.getElementById("error_flat").innerHTML = "Address is required";
       document.getElementById("error_street").innerHTML = "Address is required";
       document.getElementById("error_city").innerHTML = "Address is required";
       document.getElementById("error_state").innerHTML = "Address is required";
       document.getElementById("error_country").innerHTML = "Address is required";
       document.getElementById("error_pincode").innerHTML = "Address is required";
       return false;
   }

   // If everything is valid, return true
   return true;
}
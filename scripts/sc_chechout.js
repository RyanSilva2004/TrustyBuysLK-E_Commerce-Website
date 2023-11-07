function validateOrderForm() {


 
    var name = document.getElementById("order_name").value;
    var number = document.getElementById("order_number").value;
    var email = document.getElementById("order_email").value;
    var flat = document.getElementById("flat").value;
    var street = document.getElementById("street").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById("state").value;
    var country = document.getElementById("country").value;
    var pincode = document.getElementById("pin_code").value;
    
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
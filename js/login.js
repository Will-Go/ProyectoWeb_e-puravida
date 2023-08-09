const btnOjo = document.getElementById("ojo");

btnOjo.addEventListener("click",()=>{
    let inputPass = document.getElementById("floatingPassword");
   
    if (inputPass.type == "password"){
        inputPass.type = "text";
        btnOjo.classList.replace("ri-eye-off-fill", "ri-eye-fill"); 
    }else{
        inputPass.type = "password";
        btnOjo.classList.replace("ri-eye-fill", "ri-eye-off-fill");
    }
});
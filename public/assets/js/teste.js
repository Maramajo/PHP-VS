function teste(dados) {
    
    // if (dados == "/projetogeral/public/index.php" 
    //           || "/projetogeral/public/index.php/main"){
    //    document.getElementById("home").classList.add("active");
    //     document.getElementById("inout").classList.remove("active");
        
    // } else {
    //     document.getElementById("home").classList.remove("active");
    //     document.getElementById("inout").classList.add("active");
    
    // }
    if (dados == "users"){
        document.getElementById("home").classList.remove("active"); 
        document.getElementById("cont").classList.remove("active"); 
        document.getElementById("inout").classList.add("active");  
    } else {
        if (dados == "contato"){
             document.getElementById("home").classList.remove("active");
             document.getElementById("inout").classList.remove("active");
             document.getElementById("cont").classList.add("active");  
        } else{
             document.getElementById("home").classList.add("active");
             document.getElementById("inout").classList.remove("active");
             document.getElementById("cont").classList.remove("active");  
        }
    }
}
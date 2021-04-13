(function(){  

    window.addEventListener("DOMContentLoaded", function() { 
        console.log("salut index");

/************************ Constants and variables ******************************/

        const login = document.getElementById("login");
        const link = document.getElementsByClassName("link");
        const select = document.getElementById("select");
        const menuLogin = document.getElementsByTagName("nav")[0].getElementsByTagName("ul");

/************************ Constants and variables ******************************/


        if (document.getElementsByTagName("nav")[0].getElementsByTagName("ul")[0].getAttribute("id") === "menu") {
            link[0].addEventListener("click", function(e) {
                e.stopPropagation();
                return (login.style["display"] == "" ? login.style["display"] = "block" : login.style["display"] = "");
            })
        } 
        
        if (menuLogin[0].lastElementChild.getAttribute("id") === "message") {
            let message = document.getElementById("message");
            setTimeout(function() {
                message.style.display = "none";
                message .style.transitionProperty = "display";
                message.style.transitionDuration = "2s";
                message.style.transitionDelay = "3s";
                window.location.href = "http://localhost:8888/evaluation-6-creer-une-application-web";
            }, 3000);
        }
        
        select.addEventListener("click", function() {
            select.firstElementChild.style.outline = "none";
        })
        

    })
    })()


//Отделения
//Слайдшоу
let slideIndex = 0;
let timeout; 

showSlides(); 

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }
    
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }    
    
    slides[slideIndex - 1].style.display = "block";  
    dots[slideIndex - 1].classList.add("active");
    
    timeout = setTimeout(showSlides, 4000); 
}

let dots = document.getElementsByClassName("dot");
for (let i = 0; i < dots.length; i++) {
    dots[i].addEventListener("click", function() {
        slideIndex = i; 
        clearTimeout(timeout); 
        showSlides();   
    });
}


    document.addEventListener("DOMContentLoaded", function() {
        function showTabContent(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                if (tab.id === tabId) {
                    tab.style.display = 'block';
                } else {
                    tab.style.display = 'none';
                }
            });
            
            const navLinks = document.querySelectorAll('nav ul li a');
            navLinks.forEach(link => {
                if (link.getAttribute('href').substring(1) === tabId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
    
        showTabContent('about');
    
        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const tabId = this.getAttribute('href').substring(1);
                showTabContent(tabId);
            });
        });
    });
    
    
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



const sidebar=document.querySelector(".sidebar");
const toggle=document.querySelector(".toggle");
const contentToggle=document.querySelector(".content");
const dnone=document.querySelectorAll(".sidebar .d-sm-inline-block");
const flex=document.querySelectorAll(".sidebar .justify-content-sm-start");
const block=document.querySelectorAll(".sidebar .d-sm-block");


toggle.addEventListener("click",function(){

    dnone.forEach(item => {
        item.classList.toggle("d-sm-inline-block");
    });
    flex.forEach(item => {
        item.classList.toggle("justify-content-sm-start");
    })
    block.forEach(item => {
        item.classList.toggle("d-sm-block");
    })

    sidebar.classList.toggle("sidebarToggle");
    contentToggle.classList.toggle("contentToggle");


    if(toggle.classList.contains("bi-chevron-left")){
        toggle.classList.remove("bi-chevron-left");
        toggle.classList.add("bi-chevron-right");
    }else{
    toggle.classList.add("bi-chevron-left");
    toggle.classList.remove("bi-chevron-right");
    }
});

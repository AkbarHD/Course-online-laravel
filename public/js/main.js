// Accordion funtion
document.addEventListener('DOMContentLoaded', function() {
    const accordionBtns = document.querySelectorAll('.accordion-button');
    
    accordionBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const targetId = this.dataset.accordion;
        const targetAccordion = document.getElementById(targetId);
  
        btn.classList.toggle('open');
        targetAccordion.classList.toggle('hide');

        if (targetAccordion.classList.contains('hide')) {
            targetAccordion.style.maxHeight = "0";
            } else {
            targetAccordion.style.maxHeight = targetAccordion.scrollHeight + "px";
            }
        });
    });
});

// nav & tabs funtion like bootstrap
document.addEventListener("DOMContentLoaded", function () {
    window.openPage = function (pageName, elmnt) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.add("hidden");
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active", "border-b-[3px]", "border-[#FF6129]", "text-[#FF6129]");
        }
        document.getElementById(pageName).classList.remove("hidden");
        elmnt.classList.add("active", "border-b-[3px]", "border-[#FF6129]", "text-[#FF6129]");
        // elmnt.classList.add("active", "bg-btn-black", "text-white");
    };

    // Get the element with id="defaultOpen" and click on it
    if (document.getElementById("defaultOpen")) {
        document.getElementById("defaultOpen").click();
    }
});

// Check if #course-slider element exists
if ($('#course-slider').length) {
    // Initialize Flickity slider
    $('#course-slider').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        adaptiveHeight: true,
        groupCells: 3,
        pageDots: false,
        prevNextButtons: false
    });

    // Previous button click event
    $('.btn-prev').on('click', function() {
        $('#course-slider').flickity('previous', true);
    });

    // Next button click event
    $('.btn-next').on('click', function() {
        $('#course-slider').flickity('next', true);
    });
}

// pop up student portfolio
document.addEventListener("DOMContentLoaded", function() {
    // Check if there are elements with the data-fancybox attribute
    const fancyboxElements = document.querySelectorAll("[data-fancybox]");
    
    // If there are elements with data-fancybox attribute, bind FancyBox
    if (fancyboxElements.length > 0) {
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    }
});

function updateFileName(input) {
    console.log("updateFileName function triggered");
    if (input.files && input.files.length > 0) {
        // Get the file name
        var fileName = input.files[0].name;
        console.log(fileName);
        
        // Update the text of the <p> element inside the button
        document.getElementById('fileLabel').innerText = fileName;
    }
}
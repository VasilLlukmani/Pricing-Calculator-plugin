document.addEventListener("DOMContentLoaded", function(event) {

    let datePicker = document.querySelectorAll('input[type="date"]');
    datePicker.forEach(picker => {
        picker.addEventListener('change', _onDateSelect);
    });



    // Calculate the difference between Start and End date

    function _onDateSelect(event) {
        let dateValue = [document.querySelector('.from-day').value, document.querySelector('.to-day').value],
            date1 = new Date(dateValue[0]),
            date2 = new Date(dateValue[1]),
            timeDiff = Math.abs(date2.getTime() - date1.getTime()),
            diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));


        // Limit selected dates on calendar to 14-days gap maximum

        var max_date = new Date();
        max_date.setDate(date1.getDate() + 14);
        let str = max_date.toJSON()?.slice(0, 10);

        document.querySelector('.to-day').setAttribute("max", str);

        _showRange(diffDays);
    }

    _showRange(0);


    // Reflect changes on Range slider & on Pricing right-widget

    function _showRange(days) {

        Range = document.getElementById('range--seats');
        Range.value = days;
        var valuerange = document.getElementById("value-change"); // Show days below range slider
        valuerange.innerHTML = days;

        var price_person = document.getElementById("price-person"); // Show price per person 
        price_person.innerHTML = ((days * 10000) / 100).toFixed(2);

        var amount_persons = document.getElementById("quantity").value;
        var price_total = document.getElementById("price-total");
        price_total.innerHTML = ((days * 10000 * amount_persons) / 100).toFixed(2); // Show total price
    }


    // Listen for changes on Nr.People field  & calculate Total Pricing right-widget


    const myInput = document.querySelector('input[name="quantity"]');

    myInput.addEventListener("change", (e) => {
        var amount_persons = document.getElementById("quantity").value; // Show total price after Nr.People field value change
        var price_total = document.getElementById("price-total");
        var days = document.getElementById('range--seats').value;
        price_total.innerHTML = ((days * 10000 * amount_persons) / 100).toFixed(2);
    });


    // Listen for changes on Range Slider


    var Range = document.getElementById('range--seats');

    Range.addEventListener("input", function() {
        sliderChange(this.value);
    });

    function sliderChange(val) {

        var date1 = new Date(document.querySelector('.from-day').value); // Change End-Date after range value change
        date1.setDate(date1.getDate() + parseInt(val));
        document.querySelector('.to-day').valueAsDate = date1;



        var valuerange = document.getElementById("value-change"); // Show days below range slider after range value change
        valuerange.innerHTML = val;
        var price_person = document.getElementById("price-person"); // Show price per person after range value change
        price_person.innerHTML = ((val * 10000) / 100).toFixed(2);
        var amount_persons = document.getElementById("quantity").value; // Show total price after range value change
        var price_total = document.getElementById("price-total");
        price_total.innerHTML = ((val * 10000 * amount_persons) / 100).toFixed(2);


        return val;
    }




});
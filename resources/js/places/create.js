// public/js/custom.js

import Validator from '../validator';

const form = document.getElementById("create-place-form");

if (form) {
    form.addEventListener("submit", function (event) {
        // Reset errors messages
        // [...]
        document.getElementById("error-name").innerText = "";
        document.getElementById("error-description").innerText = "";
        document.getElementById("error-upload").innerText = "";
        document.getElementById("error-latitude").innerText = "";
        document.getElementById("error-longitude").innerText = "";
        document.getElementById("error-visibility").innerText = "";

        // Get form inputs values
        let data = {
            "name": document.getElementsByName("name")[0].value,
            "description": document.getElementsByName("description")[0].value,
            "upload": document.getElementsByName("upload")[0].value,
            "latitude": document.getElementsByName("latitude")[0].value,
            "longitude": document.getElementsByName("longitude")[0].value,
            "visibility_id": document.getElementsByName("visibility_id")[0].value,
        };

        let rules = {
            "name": "required|max:20",
            "description": "required|max:150",
            "upload": "required",
            "latitude": "required",
            "longitude": "required",
            "visibility_id": "required",
                };

        // Create validation
        let validation = new Validator(data, rules);

        // Validate fields
        if (validation.passes()) {
            // Allow submit form (do nothing)
            console.log("Validation OK");
        } else {
            // Get error messages
            let errors = validation.errors.all();
            console.log(errors);

            // Show error messages
            for (let inputName in errors) {
                let error = errors[inputName];
                document.getElementById("error-" + inputName).innerText = error[0];
            }

            // Avoid submit
            event.preventDefault();
            return false;
        }
    });
}

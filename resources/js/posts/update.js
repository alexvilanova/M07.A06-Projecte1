// public/js/custom.js

import Validator from '../validator';

const form = document.getElementById("update-post-form");

if (form) {
    form.addEventListener("submit", function (event) {
        // Reset errors messages
        // [...]
        document.getElementById("error-title").innerText = "";
        document.getElementById("error-description").innerText = "";
        document.getElementById("error-visibility").innerText = "";

        // Get form inputs values
        let data = {
            "title": document.getElementsByName("title")[0].value,
            "description": document.getElementsByName("description")[0].value,
            "visibility_id": document.getElementsByName("visibility_id")[0].value,
        };

        let rules = {
            "title": "required|max:20",
            "description": "required|max:150",
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

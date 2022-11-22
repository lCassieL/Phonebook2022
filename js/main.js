function showLoginPage() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/loginpage", true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            document.getElementById('content').innerHTML = json
        }
    };
    xhr.send('')
}

function showPhonebook() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/phonebook", true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            document.getElementById('content').innerHTML = json
        }
    }
    xhr.send('')
}

function showDetails(details_button, id) {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/details/" + id, true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            document.getElementById('details' + id).innerHTML = json
            details_button.innerHTML = "hide details"
            details_button.onclick = function() {hideDetails(details_button, id)}
        }
    }
    xhr.send('')
}

function hideDetails(details_button, id) {
    document.getElementById('details' + id).innerHTML = ''
    details_button.innerHTML = "show details"
    details_button.onclick = function(){showDetails(details_button, id)}
}

function showMyContact() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/mycontact", true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            document.getElementById('content').innerHTML = json
        }
    }
    xhr.send('')
}

function addPhone(add_button) {
    let div = document.createElement("div")
    let phone = document.createElement("input")
    phone.type = "tel"
    phone.name = "new_phones[]"
    phone.pattern = "[\+][0-9]{12}"
    phone.placeholder = "+380000000000"
    let phone_hidden = document.createElement("input")
    phone_hidden.type = "hidden"
    phone_hidden.name = "new_phones_checkbox[]"
    phone_hidden.value = "0"
    let phone_checkbox = document.createElement("input")
    phone_checkbox.type = "checkbox"
    phone_checkbox.name = "new_phones_checkbox[]"
    phone_checkbox.value = "1"
    div.append(phone, phone_hidden, phone_checkbox)
    add_button.parentNode.insertBefore(div, add_button)
}

function addEmail(add_button) {
    let div = document.createElement("div")
    let email = document.createElement("input")
    email.type = "email"
    email.name = "new_emails[]"
    let email_hidden = document.createElement("input")
    email_hidden.type = "hidden"
    email_hidden.name = "new_emails_checkbox[]"
    email_hidden.value = "0"
    let email_checkbox = document.createElement("input")
    email_checkbox.type = "checkbox"
    email_checkbox.name = "new_emails_checkbox[]"
    email_checkbox.value = "1"
    div.append(email, email_hidden, email_checkbox)
    add_button.parentNode.insertBefore(div, add_button)
}

function validateForm() {
    let selector = 'input[type="checkbox"][name="phones_checkbox[]"]' + ',' +
                   'input[type="checkbox"][name="emails_checkbox[]"]' + ',' +
                   'input[type="checkbox"][name="new_phones_checkbox[]"]' + ',' +
                   'input[type="checkbox"][name="new_emails_checkbox[]"]'
    document.querySelectorAll(selector).forEach( checkbox=>{
        if (checkbox.checked) {
            checkbox.previousElementSibling.disabled = true
        } else {
            checkbox.previousElementSibling.disabled = false
        }
    })
}
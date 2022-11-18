function showLoginPage() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/login", true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            console.log(json)
            document.getElementById('content').innerHTML = json
        }
    };
    xhr.send('')
}

function logout() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", location.origin + "/main/logout", true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let json = xhr.responseText
            console.log(json)
            document.getElementById('wrapper').innerHTML = json
        }
    }
    xhr.send('')
}
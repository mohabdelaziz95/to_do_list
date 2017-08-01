/**
 * Created by mohamed on 7/12/17.
 */

//---------- register form ----------
var register_form = document.getElementById('register-form');
var successMessage = document.getElementById('successMessage');
var errorMessage = document.getElementById('errorMessage');

//---------- register form ----------
var login_form = document.getElementById('login-form');

//---------------------------------------------------------------------------------

// ---------- todo form ---------------
var todo_form = document.getElementById('TodoForm');
// ---------------------------------------------------------------------------------

var profilePage = document.getElementById('profile');
var ToDoPage = document.getElementById('todo');
// ---------------------------------------------------------------------------------

function showSuccess() {
    successMessage.style.display = "block";
}

function hideSuccess() {
    successMessage.style.display = "none";
}

function showErrors() {
    errorMessage.style.display = "block";
}

function hideErrors() {
    errorMessage.style.display = "none";
}

function redirect(location, time) {
    window.setTimeout(function() { window.location.href = location }, time);
}

function showUpdatePage() {
    var updatePage = document.getElementById('update-profile');
    if (updatePage.style.display = "none") {
        updatePage.style.display = "block";
    }

}

function hideProfilePage() {
    var profilePage = document.getElementById('profile');
    if (profilePage.style.display = "block") {
        profilePage.style.display = "none";
    }
}

function showProfilePage() {
    if (profilePage.style.display = "none") {
        profilePage.style.display = "block";
        hideToDoPage();
    }
}

function showToDoPage() {
    if (ToDoPage.style.display = "none") {
        ToDoPage.style.display = "block";
        hideProfilePage();
    }
}

function showLastInsertedId() {
    var last_inserted_id = document.getElementById('lastInsertedId');
    if (last_inserted_id.style.display = "none") {
        last_inserted_id.style.display = "block";
    }
}

function remove(x) {
    var list = document.querySelectorAll('#list-group li');
    li = list[x];
    li.parentNode.removeChild(li);

}

function hideToDoPage() {
    var ToDoPage = document.getElementById('todo');
    if (ToDoPage.style.display = "block") {
        ToDoPage.style.display = "none";
    }
}

function validation() {

    var action = register_form.getAttribute('action');
    var form_data = new FormData(register_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var result = xhr.responseText;
            errorMessage.innerHTML = result;
            if (result === "") {
                showSuccess();
                hideErrors();
                redirect('index.php', 3000);
            } else {
                showErrors();
                hideSuccess()
            }

            console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function register() {

    validation();

    var action = register_form.getAttribute('action');
    var form_data = new FormData(register_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = xhr.responseText;
            //console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function loginValidation() {

    var action = login_form.getAttribute('action');
    var form_data = new FormData(login_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var result = xhr.responseText;
            errorMessage.innerHTML = result;
            if (result === "") {
                hideErrors();
                redirect('home.php', 100);
            } else {
                showErrors();
            }

            console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function logIn() {

    loginValidation();
    var action = login_form.getAttribute('action');
    var form_data = new FormData(login_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = xhr.responseText;
            //console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function updateValidation() {

    var update_form = document.getElementById('updateForm');
    var action = update_form.getAttribute('action');
    var form_data = new FormData(update_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var result = xhr.responseText;
            errorMessage.innerHTML = result;
            showErrors();
            redirect('home.php', 500);
            hideSuccess();

            console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function updateProfile() {
    updateValidation();

    var update_form = document.getElementById('updateForm');
    var action = update_form.getAttribute('action');
    var form_data = new FormData(update_form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = xhr.responseText;
        }
    };
    xhr.send(form_data);
}

function todo() {

    var action = todo_form.getAttribute('action');
    var form_data = new FormData(todo_form);
    var showToDo = document.getElementById('show');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = xhr.responseText;
            showToDo.innerHTML = result;
            showLastInsertedId();
            console.log('Result: ' + result);
        }
    };
    xhr.send(form_data);
}

function deleteList() {

    var deleteRequest = new FormData(todo_form);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'delete.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            remove(result);
        }
    };
    xhr.send(deleteRequest);
}


/**
 * Created by mohamed on 7/12/17.
 */

//---------- register form ----------
var register_form = document.getElementById('register-form');
var register_button = document.getElementById('signUp');
var successMessage = document.getElementById('successMessage');
var errorMessage = document.getElementById('errorMessage');

//---------- register form ----------
var login_form = document.getElementById('login-form');
var login_button = document.getElementById('login');
//---------------------------------------------------------------------------------

//---------- edit profile-------------
var edit = document.getElementById('edit');

//---------- update form -------------
var update_form = document.getElementById('update-form');
var update_button = document.getElementById('update-button');
//---------------------------------------------------------------------------------

// ---------- todo form ---------------
var todo_form = document.getElementById('TodoForm');
var todo_button = document.getElementById('Add');
var delete_button = document.getElementById('delete-button');
var mark_as = document.getElementById('notdone');
// ---------------------------------------------------------------------------------

var profilePage = document.getElementById('profile');
var ToDoPage = document.getElementById('todo');
var show_profile_page_button = document.getElementById('showProfile');
var show_todo_page_button = document.getElementById('showToDo');
var show_update_page_button = document.getElementById('edit');


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
//show_update_page_button.addEventListener('click', showUpdatePage);

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
//show_profile_page_button.addEventListener('click', showProfilePage);

function showToDoPage() {
    if (ToDoPage.style.display = "none") {
        ToDoPage.style.display = "block";
        hideProfilePage();
    }
}
//show_todo_page_button.addEventListener('click', showToDoPage);

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
/**if (typeof register_button === null) {
    register_button.addEventListener('click', register);
}**/

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
/**if (typeof login_button === null) {

}**/
//login_button.addEventListener('click', logIn);
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
/**if (typeof update_button === null) {
    update_button.addEventListener('click', updateProfile);
}**/

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
//todo_button.addEventListener('click', todo);

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
//delete_button.addEventListener('click', deleteList);

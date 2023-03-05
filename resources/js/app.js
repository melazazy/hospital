import { toInteger } from 'lodash';
import './bootstrap';

$(document).ready(function () {
    let type = document.getElementById('type');

    let department = document.getElementById('department-div');
    if (type) {
        type.addEventListener("change", function () {
            if (type.value == 'patient') {
                department.classList.add('hidden');
            }
            else {
                if (department.classList.contains('hidden')) {
                    department.classList.remove('hidden');
                }
            }
        });
    }

    // Department Change
    $('#book-department-option').change(function () {
        // Department id
        let id = $(this).val();
        $('#book-doctor-option').find('option').remove();
        $.ajax({
            url: '/getAppoints/' + id,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                let len = 0;
                if (response != null) {
                    len = response.length;
                }
                if (len > 0) {
                    // Read data and create <option >
                    for (let i = 0; i < len; i++) {
                        let id = response[i].id;
                        let user_id = response[i]['doctor'].id;
                        // console.log(user_id);
                        let date = response[i].appoint_date;
                        let time = response[i].appoint_time;
                        let doctor = response[i]['doctor']['user_detail']['full_name'];
                        console.log(response[i]['doctor']['user_detail']['full_name']);
                        let option = "<option value='" + id + "'>" + date + ' | ' + time + ' | ' + doctor + "</option>";
                        $("#book-doctor-option").append(option);
                    }
                }
                else {
                    let option = "<option value='0'> No avilable Appointments </option>";
                    $("#book-doctor-option").append(option);
                }
            }
        });
    });
    $('#make-department-option').change(function () {
        // Department id
        let id = $(this).val();
        $('#make-doctor-option').find('option').remove();
        // AJAX request
        $.ajax({
            url: '/getDoctor/' + id,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                let len = 0;
                if (response != null) {
                    len = response.length;
                }
                if (len > 0) {
                    // Read data and create <option >
                    for (let i = 0; i < len; i++) {
                        let id = response[i].user_id;
                        let doctor = response[i].full_name;
                        let option = "<option value='" + id + "'>" + doctor + "</option>";
                        $("#make-doctor-option").append(option);
                    }
                }
                else {
                    let option = "<option value='0'> Not avilable Doctors </option>";
                    $("#make-doctor-option").append(option);
                }
            }
        });
    });
    $('#make-room-option').change(function () {
        // Department id
        let id = $(this).val();
        $('#book-room-option').find('option').remove();
        // AJAX request
        $.ajax({
            url: '/getroom/' + id,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                let len = 0;
                if (response != null) {
                    len = response.length;
                }
                if (len > 0) {
                    // Read data and create <option >
                    for (let i = 0; i < len; i++) {
                        let id = response[i].id;
                        let type = response[i].type;
                        let num = response[i].room_num;
                        let option = "<option value='" + id + "'>" + type + "|" + num + "</option>";
                        $("#book-room-option").append(option);
                    }
                }
                else {
                    let option = "<option value='0'> No avilable Room in this Department </option>";
                    $("#book-room-option").append(option);
                }
            }
        });
    });
    /**
    $('#make-user-option').change(function () {
        // Department id
        let id = $(this).val();
        $('#book-room-option').find('option').remove();
        // AJAX request
        $.ajax({
            url: '/getroom/' + id,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                let len = 0;
                if (response != null) {
                    len = response.length;
                }
                if (len > 0) {
                    // Read data and create <option >
                    for (let i = 0; i < len; i++) {
                        let id = response[i].id;
                        let type = response[i].type;
                        let num = response[i].room_num;
                        let option = "<option value='" + id + "'>" + type + "|" + num + "</option>";
                        $("#book-room-option").append(option);
                    }
                }
                else {
                    let option = "<option value='0'> No avilable Room in this Department </option>";
                    $("#book-room-option").append(option);
                }
            }
        });
    });
    */
    //total charge
    let charges = document.querySelectorAll('.charges');
    let totalcharges = document.querySelector('#total_charge');
    $(charges).change(function () {
        let total = 0;
        charges.forEach(e => {
            total += toInteger(e.value);
        });
        totalcharges.value = total;
    });

    // Set date time to input form
    let date = document.querySelectorAll('.emergDate');
    let time = document.querySelectorAll('.emergTime');
    date.forEach(d => {
        d.value = new Date().toISOString().slice(0, 10);
    });
    time.forEach(t => {
        t.value = new Date().toLocaleTimeString([], { hour12: false, hour: '2-digit', minute: '2-digit' });
    });

    // Medecine Select
    $("#add").click(function () {
        let newRowAdd = `<div id="row"> <div class="input-group m-3">
            <input name="medicine[]" type="text" class="form-control medicine" placeholder="medic">
            <input name="id[]" type="hidden" class="form-control medicine" placeholder="id">
            <input name="repeat[]" type="number" class="form-control repeat" placeholder="repeat in day">
            <input name="days[]" type="number" class="form-control days" placeholder="repeat days">
            <div class="input-group-prepend">
                <button class="btn btn-danger" id="DeleteRow" type="button"><i class='bx bx-trash'></i></button>
            </div></div></div>`;
        $('#newinput').append(newRowAdd);
        let inputs = document.querySelectorAll('.medicine');
        // console.log(inputs);
        inputs.forEach(e => {
            $(e).keyup(function () {
                let medic = $(e).val();
                if (medic != "") {
                    $.ajax({
                        url: '/getMedicine/' + medic,
                        type: 'get',
                        dataType: 'json',
                        success: function (response) {
                            let len = response.length;
                            $("#searchResult").empty();
                            for (let i = 0; i < len; i++) {
                                let id = response[i]['id'];
                                let name = response[i]['name'];
                                $("#searchResult").append("<li value='" + id + "'>" + name + "</li>");

                            }
                            // binding click event to li
                            $("#searchResult li").bind("click", function () {
                                let id = $(this).val();
                                let value = $(this).text();
                                $(e).val(value);
                                $(e).next().val(id);
                                $("#searchResult").empty();
                            });
                        }
                    });
                }
            });
        });
    });

    let searchUser = document.getElementById('user_name');

    $(searchUser).keyup(function () {
        let user = $(searchUser).val();
        if (user != "") {
            $.ajax({
                url: '/getUser/' + user,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    let len = response.length;
                    $("#userResult").empty();
                    for (let i = 0; i < len; i++) {
                        let email = response[i]['email'];
                        // console.log(email);
                        let name = response[i]['username'];
                        $("#userResult").append("<li data-value='" + email + "'>" + name + "</li>");
                    }
                    // binding click event to li
                    $("#userResult li").bind("click", function () {
                        let value = this.dataset.value;
                        // console.log(value);
                        $(searchUser).val(value);
                        $("#userResult").empty();
                    });
                }
            });
        }
    });

    let id = document.getElementById('mailcountid').value;
    let count = document.getElementById('mailcount');
    $.ajax({
        url: '/getMailCount/' + id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response > 0) {
                count.innerHTML = response;
            }
            else
                count.remove();
        }
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    });


    // Dashboard JS File
    let sidebar = document.querySelector(".sidebar");
    let sidebarA = document.querySelector(".sidebar li a");
    let logo_name = document.querySelector(".logo_name");
    let sidebarBtns = document.querySelectorAll(".sidebarBtn");
    sidebarBtns.forEach(sidebarBtn => {
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (logo_name.innerHTML == 'Hospital') {
                logo_name.innerHTML = "<i class='bx bx-heading text-info'></i>";
            }
            else {
                logo_name.innerHTML = 'Hospital';
            }
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };
    });
    let link = document.querySelectorAll(".links_name");
    link.forEach(linkBtn => {
        linkBtn.closest('a').onclick = function () {
            if (linkBtn.classList.contains("logout")) {
                event.preventDefault();
                let log = document.getElementById('logout-form').submit();
            }
            else if (linkBtn.nextElementSibling.classList.contains("bx-chevrons-right")) {
                linkBtn.nextElementSibling.classList.replace("bx-chevrons-right", "bx-chevrons-down");
            } else
                linkBtn.nextElementSibling.classList.replace("bx-chevrons-down", "bx-chevrons-right");
        };
    });
    let createInput = document.getElementById('medicine_name');
    $(createInput).keyup(function () {
        let medic = $(createInput).val();
        if (medic != "") {
            $.ajax({
                url: '/getMedicine/' + medic,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    let len = response.length;
                    $("#searchResult").empty();
                    for (let i = 0; i < len; i++) {
                        let id = response[i]['id'];
                        let name = response[i]['name'];
                        $("#searchResult").append("<li value='" + id + "'>" + name + "</li>");

                    }
                    // binding click event to li
                    $("#searchResult li").bind("click", function () {
                        let id = $(this).val();
                        let value = $(this).text();
                        $(createInput).val(value);
                        $(createInput).next().val(id);
                        $.ajax({
                            url: '/getMedicineid/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function (response) {
                                let id_input = document.getElementById('medicine_id');
                                let code_input = document.getElementById('medicine_code');
                                let price_input = document.getElementById('medicine_price');
                                let quantity_input = document.getElementById('medicine_quantity');
                                let limit_input = document.getElementById('medicine_limit');
                                id_input.value = response['id'];
                                code_input.value = response['code'];
                                price_input.value = response['Medicine_price'];
                                quantity_input.value = response['start_quantity'];
                                limit_input.value = response['limit_quant'];
                                console.log(response);
                            }
                        });
                        $("#searchResult").empty();
                    });
                }
            });
        }
    });
    // End dashboard JS File
});

window.onload = () => {
    // console.log("radi");
    print_title_of_current_page();

/*================================
    => EVENT ON CLICK
==================================*/
    // index.php#contact; onclick
    $("#btnSendMessage").on('click', checkContactForm);
    // register.php
    $("#btnSignUp").on('click', checkRegisterForm);
    // login.php
    $("#btnLogin").on("click", checkLoginForm);
    // insert a new perfume => administrator-access.php
    $("#btnInsert").on("click", checkInsertPerfumeForm);
    // update perfume => administrator-access.php
    $('#btnUpdate').on('click', checkUpdatePerfumeForm);
    // update user
    $("#btnEditUser").on('click', checkUserBeforeEdit);
    // insert price 
    $("#btnSizePrice").on('click', insertPrice);
    $(document).on("click", "#deletePerfume", function(){
        var idPerfumeToDelete = $(this).data("idperfume");
        console.log(idPerfumeToDelete);
        var id = {
            idPerfumeToDelete: idPerfumeToDelete,
            "btnDelete": true
        };
        ajaxCallback("models/delete-perfume.php", "POST", id, function(result){
            // console.log(result);
            setTimeout(function() { window.location=window.location; }, 1500);
        },'JSON')
    })
/*================================
    => EVENT ON CHANGE
==================================*/
/*-------------------------------
    => GET CATEGORIES, FILTER
---------------------------------*/
     $(`input[name="arrayCategories[]"]`).on('change', function() {
        var selectedCategories = new Array();
        // var checked = $('input[name="category[]"]:checked').val();
        // console.log(checked)
        $('input[name="arrayCategories[]"]:checked').each(function(el){
			selectedCategories.push(parseInt($(this).val()));
            console.log(selectedCategories);
		});
        var categories = {
            arrayCategories: selectedCategories
        };
        console.log("sta saljemo serveru? => " + categories)
        ajaxCallback("models/filter-categories.php", "POST", categories, function(result){
            console.log(result);
            printPerfumes(result);
        })
    });
/*----------------------------------------------------------------------
    => GET BRANDS, FILTER
----------------------------------------------------------------------*/
    $(`input[name="arrayBrands[]"]`).on('change', function() {
        var selectedBrands = [];
        // var checked = $('input[name="category[]"]:checked').val();
        // console.log(checked)
        $('input[name="arrayBrands[]"]:checked').each(function(el){
			selectedBrands.push(parseInt($(this).val()));
            // console.log(selectedBrands);
		});
        var brands = {
            arrayBrands: selectedBrands
        };
        ajaxCallback("models/filter-brands.php", "POST", brands, function(result){
            // console.log(result);
            printPerfumes(result);
        })
    });
/*----------------------------------------------------------------------
    => SORT BY PRICE, SHOP.PHP - DROPDOWN LIST
----------------------------------------------------------------------*/
  $("#ddlSort").on("change", function(){
    var sortValue = $("#ddlSort").val();
    // console.log(sortValue)
    var sortData = {
        sort: sortValue
    };
    // alert(sortValue)
    ajaxCallback("models/sort-by-price.php", "GET", sortData, function(result){
        //console.log(result);
        printPerfumes(result);
    });
});
/*----------------------------------------------------------------------
    => CHANGE PRICE BY MILLILITERS, SINGLE-PERFUME.PHP
----------------------------------------------------------------------*/
$('#sizeMl').change(function () {
    var size =  $('#sizeMl').val();
    //var id = $("#idPerfume").val();
    var idSplit = window.location.search.split("="); // ?id=1
    console.log(idSplit[1])
    var id = idSplit[1];
    // alert(size);
    var size = {
        size: size,
        idPerfumePrice: id
    };
    ajaxCallback("models/change-by-price.php", 'POST', size, function(result){
        // console.log(result);
        printPrice(result.price);
    });
});

    // korpa
    // $(document).on("change", "#sizeMl", function(){
    //     var size = $("#sizeMl").val();
    //     var id = $("#idPerfume").val();
    //     console.log(id)
    //     var size = {
    //         'sizeMl': size,
    //         'idPerfumePrice' : id
    //     };
    //     ajaxCallback("models/change-by-price.php", "POST", size, function(result){
    //         console.log(result)
    //         printPrice(result);
    //     }, 'JSON')
    // });

/*----------------------------------------------------------------------
    => SEARCH BY NAME, BRAND, CATEGORY, SHOP.PHP
-----------------------------------------------------------------------*/
    $(document).on("keyup", "#searchPerfumes", function(){
        var searchValue = $(this).val();
        // console.log(serachValue);
        var search = {
            search: searchValue
        };
        console.log(search)
        ajaxCallback("models/search.php", "POST", search, function(result){
            if(result){
                console.log(result);
                printPerfumes(result);
            }
        })
    });



    $("#btnAdd").on('click', function(){
        var size = $("#sizeMl").val();
        var quantity = $("#quantity").val();
       
        var size = $("#sizeMl").val();
        var quantity = $("#quantity").val();
        console.log(size)
        console.log(quantity)
        var orderDetails = {
            size: size,
            quantity: quantity
        };
        ajaxCallback("models/add-to-cart.php", "POST", orderDetails, function(result){
            console.log(result)
        }, 'JSON')
         
    })

}


/*--------------
    FUNCTIONS
--------------*/

/*----------------------------------------------------------------------
    => AJAX CALLBACK
----------------------------------------------------------------------*/
function ajaxCallback(url, method, data, result, dataType){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: dataType,
        success: result,
        error: function(xhr, status, error){
            console.error("AJAX error:" + error);
            console.log("Response text:" + xhr.responseText)
            // console.error("Status Text: " + xhr.statusText);
            // console.error("Response Text: " + xhr.responseText);
        }
    });
}
/*----------------------------------------------------------------------
    => PRINT TITLE OF THE CURRENT PAGE
----------------------------------------------------------------------*/
function print_title_of_current_page(){
    var home = document.getElementById("nav1").href;
    var shop = document.getElementById("nav2").href;
    var contact = document.getElementById("nav3").href;
    var login = document.getElementById("nav4").href;
    var print = '';
    if (window.location.href == home){
        print = ' - Home';
    }
    else if (window.location.href == shop){
        print = ' - Shop';
    }
    else if (window.location.href == contact){
        print = ' - Contact';
    }
    else if(window.location.href == login){
        print = ' - Sign in';
    }
    var title = document.title += print;
    //console.log(document.title);
    //console.log(title);
}


/*----------------------------------------------------------------------
    => INFO POPOVER = single-perfume.php
----------------------------------------------------------------------*/
$(function () {
    $("[data-toggle=popover]")
    .popover({ html: true})
        .on("focus", function () {
            $(this).popover("show");
        }).on("focusout", function () {
            var _this = this;
            if (!$(".popover:hover").length) {
                $(this).popover("hide");
            }
            else {
                $('.popover').mouseleave(function() {
                    $(_this).popover("hide");
                    $(this).off('mouseleave');
                });
            }
        });
});


/*----------------------------------------------------------------------
    => CHECK CONTACT FORM, REGEX
----------------------------------------------------------------------*/
function checkContactForm(event){
    event.preventDefault();
    var errors = 0;
    var firstName = $("#first-name");
    //console.log(firstName);

    var lastName = $("#last-name");
    //console.log(lastName);

    var email = $("#email");
    //console.log(email);

    var message = $("#messageTextarea");
    // console.log(message);

    // info messages for users
    var spanMessage = document.getElementsByClassName("spanInfo");  // 4; one for each field

    // message textarea 

    if(message.val() == ''){
        errors++;
        console.log(errors)
        spanMessage[3].innerHTML = '<i class=\"fa-solid fa-circle-info\"></i> Please be as detailed as possible &#129488;';
        message.css("border", "2px solid rgba(255, 0, 0, 0.863)");
    }
    else {
        spanMessage[3].innerHTML = '';
        message.css("border", 'none');
        message.css("border-bottom", '2px solid #000');
        message.css("background-color", "rgba(196, 222, 255, 0.4)");
    }


    /* ----REGEX---- */
    // first name
    var reFirstName = /^[A-Z][a-z]{2,15}$/;

    // possibility of two last names => last name
    var reLastName = /^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/;

    //  email => example.12_3@gmail.com (example)
    var reEmail = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;

    /* ----TEST REGEX---- */
    // first name
    if(!reFirstName.test(firstName.val()))
    {
        firstName.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessage[0].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessage[0].innerHTML = "";
        firstName.css("border", 'none');
        firstName.css("border-bottom", '2px solid #000');
        firstName.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    // last name
    if(!reLastName.test(lastName.val()))
    {
        lastName.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessage[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessage[1].innerHTML = "";
        lastName.css("border", 'none');
        lastName.css("border-bottom", '2px solid #000');
        lastName.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    // email
    if(!reEmail.test(email.val()))
    {
        email.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessage[2].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> Format required for this field: example@yahoo.com. Also, you can use numbers or special characters (in this case . or _)";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessage[2].innerHTML = "";
        email.css("border", 'none');
        email.css("border-bottom", '2px solid #000');
        email.css("background-color", "rgba(196, 222, 255, 0.4)");
    }

    // console.log(errors);

    if(errors == 0){
        // console.log(errors);
        var dataToSend = {
            "firstName": $("#first-name").val(),
            "lastName": $("#last-name").val(),
            "email": $("#email").val(),
            "messageContent": $("#messageTextarea").val(),
            "btnSend": true
        };
        console.log(dataToSend);
        ajaxCallback("models/contact-form-data.php", "POST", dataToSend, function(result){
            $("#responseText").html(`${result.msg}`); 
        }, 'JSON');
    }
    else {
        // console.log('ukupno: ' + errors)
    }

}


/*----------------------------------------------------------------------
    => CHECK REGISTER FORM, REGEX
----------------------------------------------------------------------*/
function checkRegisterForm(){
    //event.preventDefault();
    var errors = 0;
    var firstNameR = $("#firstNameRegister");
    //console.log(firstNameR);

    var lastNameR = $("#lastNameRegister");
    //console.log(lastNameR);

    var emailR = $("#emailRegister");
    //console.log(emailR);
    var password = $("#passwordRegister");

    var reFirstNameR = /^[A-Z][a-z]{2,15}$/;
    var reLastNameR = /^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/;
    var reEmailR = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
    // min 8 karaktera, barem jedno veliko slovo; barem jedno malo slovo; barem jedan specijalan karakter; barem jedan broj;
    var rePasswordR = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;
    var spanMessageReg = document.getElementsByClassName('spanInfoReg');
    /* ----TEST REGEX---- */
    // first name
    if(!reFirstNameR.test(firstNameR.val()))
    {
        firstNameR.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessageReg[0].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessageReg[0].innerHTML = "";
        firstNameR.css("border", 'none');
        firstNameR.css("border-bottom", '2px solid #000');
        firstNameR.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    // last name
    if(!reLastNameR.test(lastNameR.val()))
    {
        lastNameR.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessageReg[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessageReg[1].innerHTML = "";
        lastNameR.css("border", 'none');
        lastNameR.css("border-bottom", '2px solid #000');
        lastNameR.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    // email
    if(!reEmailR.test(emailR.val()))
    {
        emailR.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessageReg[2].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> Format required for this field: example@yahoo.com. Also, you can use numbers or special characters (in this case . or _)";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessageReg[2].innerHTML = "";
        emailR.css("border", 'none');
        emailR.css("border-bottom", '2px solid #000');
        emailR.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    // password
    if(!rePasswordR.test(password.val()))
    {
        password.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanMessageReg[3].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 8 characters. Use at least one number, one uppercase letter, one lowercase letter and one special character.";
        errors++;
        // console.log(errors)
    }
    else
    {
        spanMessageReg[3].innerHTML = "";
        password.css("border", 'none');
        password.css("border-bottom", '2px solid #000');
        password.css("background-color", "rgba(196, 222, 255, 0.4)");
    }
    
    if(errors == 0){
        var newUser = {
            firstNameUser: $("#firstNameRegister").val(),
            lastNameUser: $("#lastNameRegister").val(),
            emailUser: $("#emailRegister").val(),
            passwordUser: $("#passwordRegister").val(),
            btnRegistered: true
        };
        // console.log(newUser);
        $("#info").html("");
        //$("#formregister").submit();
        ajaxCallback("models/registration-form.php", "POST", newUser, function(result){
            $("#response").html(`${result.msg}`);
            console.log(result.msg)
            setTimeout(function() { window.location=window.location;}, 1500);
        }, 'JSON');
    }
    else {
        $("#info").html("Please fill in all the required fields.");
        //console.log("ukupan broj gresaka: " + errors);
    }

}

/*----------------------------------------------------------------------
    => CHECK LOGIN FORM, REGEX
----------------------------------------------------------------------*/

function checkLoginForm() {
    var errors = 0;

    var emailLogin = $('#emailLogin');
    var passwordLogin = $("#passwordLogin");
    var spanLog = document.getElementsByClassName("spanLog");

    // regex
    var reEmailL = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
    var rePasswordL = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;

    // Email validation
    if (!reEmailL.test(emailLogin.val())) {
        emailLogin.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanLog[0].innerHTML = "<i class='fa-solid fa-circle-info'></i> Format required: example@yahoo.com.";
        errors++;
    } else {
        spanLog[0].innerHTML = "";
        emailLogin.css({"border": 'none', "border-bottom": '2px solid #000', "background-color": "rgba(196, 222, 255, 0.4)"});
    }

    // Password validation
    if (!rePasswordL.test(passwordLogin.val())) {
        passwordLogin.css("border", "2px solid rgba(255, 0, 0, 0.863)");
        spanLog[1].innerHTML = "<i class='fa-solid fa-circle-info'></i> Password must be at least 8 characters with one uppercase, one lowercase, one number, and one special character.";
        errors++;
    } else {
        spanLog[1].innerHTML = "";
        passwordLogin.css({"border": 'none', "border-bottom": '2px solid #000', "background-color": "rgba(196, 222, 255, 0.4)"});
    }

    // Encrypt password
    if (errors === 0) {
        // pristup prema NAME-ovima
        // var encryptedPassword = CryptoJS.MD5(passwordLogin.val()).toString();
        // console.log(encryptedPassword)
        
        var user_logged = {
            "emailLogged": emailLogin.val(),
            "passwordLogged": passwordLogin.val(),
            "btnSignIn": true
        };
        console.log("Data to be sent:", user_logged);
        
        ajaxCallback("models/login-form.php", 'POST', {data:JSON.stringify(user_logged)}, function(result) {
            console.log(result.msg);
            $("#responseLog").html(result.msg);
            setTimeout(function() { window.location.reload(); }, 1500);
        }, 'json');
    }
}


/*----------------------------------------------------------------------
    => CHECK USER DATA BEFORE EDITING
----------------------------------------------------------------------*/
function checkUserBeforeEdit(){
    var firstNameU = $("#firstNameUserData");
    var lastNameU = $("#lastNameUserData");
    var emailU = $("#emailUserData");
    var passwordU = $("#passwordUserData"); // ako je lozinka prazan string onda se ne update-uje!!
    var spanMess = document.getElementsByClassName("userData");
    var userId = $("#userId").val();
    //console.log(userId)
    var errors = 0;
    var reFirstNameU = /^[A-Z][a-z]{2,15}$/;
    var rePasswordU = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;
    var reLastNameU = /^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/;
    var reEmailU = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
        //password
        if(passwordU.val() != ''){
            if(!rePasswordU.test(passwordU.val()))
            {
                passwordU.css("border", "2px solid rgba(255, 0, 0, 0.863)");
                spanMess[3].innerHTML = " <i class=\"fa-solid fa-circle-info\"></i> This field must be at least 8 characters. Use at least one number, one uppercase letter, one lowercase letter and one special character.";
                errors++;
                // console.log(errors)
            }
            else
            {
                spanMess[3].innerHTML = "";
                passwordU.css("border", 'none');
                passwordU.css("border-bottom", '2px solid #000');
                passwordU.css("background-color", "rgba(196, 222, 255, 0.4)");
            }
        }
      // first name
      if(!reFirstNameU.test(firstNameU.val()))
      {
          firstNameU.css("border", "2px solid rgba(255, 0, 0, 0.863)");
          spanMess[0].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
          errors++;
          // console.log(errors)
      }
      else
      {
          spanMess[0].innerHTML = "";
          firstNameU.css("border", 'none');
          firstNameU.css("border-bottom", '2px solid #000');
          firstNameU.css("background-color", "rgba(196, 222, 255, 0.4)");
      }
      // last name
      if(!reLastNameU.test(lastNameU.val()))
      {
          lastNameU.css("border", "2px solid rgba(255, 0, 0, 0.863)");
          spanMess[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> This field must be at least 3 characters.";
          errors++;
          // console.log(errors)
      }
      else
      {
          spanMess[1].innerHTML = "";
          lastNameU.css("border", 'none');
          lastNameU.css("border-bottom", '2px solid #000');
          lastNameU.css("background-color", "rgba(196, 222, 255, 0.4)");
      }
      // email
      if(!reEmailU.test(emailU.val()))
      {
          emailU.css("border", "2px solid rgba(255, 0, 0, 0.863)");
          spanMess[2].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> Format required for this field: example@yahoo.com. Also, you can use numbers or special characters (in this case . or _)";
          errors++;
          // console.log(errors)
      }
      else
      {
          spanMess[2].innerHTML = "";
          emailU.css("border", 'none');
          emailU.css("border-bottom", '2px solid #000');
          emailU.css("background-color", "rgba(196, 222, 255, 0.4)");
      }
      if(errors == 0){
          var updatedData = {
              userFirstName: $("#firstNameUserData").val(),
              userLastName: $("#lastNameUserData").val(),
              userEmail: $("#emailUserData").val(),
              userPassword: $("#passwordUserData").val(),
              userId: $("#userId").val(),
              btnEditUser: true
          };
        //   console.log(updatedData)
        ajaxCallback("models/update-user.php", "POST", updatedData, function(result){
            console.log(result.msg);
            $("#infoUser").html(`${result.msg}`);
            setTimeout(function() { window.location=window.location;}, 3000);
        }, 'JSON');
      }
}

/*----------------------------------------------------------------------
    => CHECK INSERT PERFUME FORM
----------------------------------------------------------------------*/
function checkInsertPerfumeForm(){
    var namePerfume = $("#namePerfume");
    var photo = $("#uploadPhoto");
    var desc = $("#description");
    var brand = $("#ddlBrandInsert");
    var category = $("#ddlCategoryInsert");
    var spanInsert = document.getElementsByClassName("spanInsert");
    var highlighted = $("input[name='highlighted']:checked");
    var err = 0;
    // console.log(namePerfume);
    // console.log(document.querySelector('input[type=file]').files[0]);
    // console.log(desc);
    // console.log(brand);
    // console.log(category);
    // console.log(highlighted)
    

    // perfume
    if(namePerfume.val() == ''){
        err++;
        spanInsert[0].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to fill in this field. ";
    }
    else {
        spanInsert[0].innerHTML = "";
    }
    // photo
    var regexPhoto = /^([a-zA-Z0-9\s_\\.\-])+(.png|.jpg|.jpeg)$/;
    if((typeof document.querySelector('input[type=file]').files[0]) == "undefined"){
                err++;
                spanInsert[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to upload a photo.  ";
            }
            else {
                spanInsert[1].innerHTML = "";
            }
        if((typeof document.querySelector('input[type=file]').files[0]) != "undefined") {
            if(!regexPhoto.test(document.querySelector('input[type=file]').files[0]['name'])){
                err++;
                spanInsert[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> Photo needs to be jpg, jpeg or png. ";
            }
                else {
                    spanInsert[1].innerHTML = "";
            }
        }
    // description
    if(desc.val() == 0){
        err++;
        spanInsert[2].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to fill in this field. ";
    }
    else {
        spanInsert[2].innerHTML = "";
    }
    // brand
    if(brand.val() == 0){
        err++;
        spanInsert[3].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to choose a brand. ";
    }
    else {
        spanInsert[3].innerHTML = "";
    }
    // category
    if(category.val() == 0){
        err++;
        spanInsert[4].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to choose a category. ";
    }
    else {
        spanInsert[4].innerHTML = "";
    }

    if(err == 0){
        var newPerfume = {
            'namePerfumeInsert': $("#namePerfume").val(),
            'photoInsert': document.querySelector('input[type=file]').files[0]['name'],
            'descriptionInsert': $("#description").val(),
            'brandInsert' : $("#ddlBrandInsert").val(),
            'categoryInsert': $("#ddlCategoryInsert").val(),
            'btnInsert': true
        };
            // console.log(newPerfume)
            ajaxCallback("models/insert-perfume-form.php", "POST", newPerfume, function(result){
                // console.log(result);
                $("#responseInserted").html(`${result.msg}`);
            }, 'JSON');
        
    }


}
/*----------------------------------------------------------------------
    => CHECK INSERT PRICE
----------------------------------------------------------------------*/
function insertPrice(){
    var idPerfume = $("#perfume");
    var size = $("#size");
    var price = $("#price");
    var spanSize = $("#spanSize");

    var err=0;

    if(price.val() == ''){
        err++;
        spanSize.html("<i class=\"fa-solid fa-circle-info\"></i> You need to fill in this field. ");
    }
    else {
        spanSize.html("");
    }

    if(err == 0){
        var price = {
            "idPerfume" : $("#perfume").val(),
            "idSize" : $("#size").val(),
            "price": $("#price").val(),
            "btnPriceSize": true
        }
        console.log(price);
        ajaxCallback("models/insert-price.php", "POST", price, function(result){
            console.log(result);
            $("#responseSizePrice").html(`${result.msg}`);
        }, 'JSON')
    }


}

/*----------------------------------------------------------------------
    => CHECK UPDATE PERFUME FORM
----------------------------------------------------------------------*/
function checkUpdatePerfumeForm(){
    var idPerfume = $("#idPerfume");
    var namePerfume = $("#perfumeName");
    // var photo = document.querySelector('input[type=file]').files;
    var desc = $("#desc");
    var brand = $("#ddlBrandUpdate");
    var category = $("#ddlCategoryUpdate");
    var spanUpdate = document.getElementsByClassName("spanUpdate");
    var highlighted = $("input[name='highlighted']:checked");
    var err = 0;
    //     console.log(namePerfume);
    //     console.log(photo);
    //     console.log(desc);
    //     console.log(brand);
    // console.log(category.val());
    //     console.log(idPerfume.val())
    console.log(highlighted.val())

    if(namePerfume.val() == ''){
        err++;
        spanUpdate[0].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to fill in this field. ";
    }
    else {
        spanUpdate[0].innerHTML = "";
    }
    // description
    if(desc.val() == ''){
        err++;
        spanUpdate[2].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to fill in this field. ";
    }
    else {
        spanUpdate[2].innerHTML = "";
    }
    // brand
    if(brand.val() == 0){
        err++;
        spanUpdate[3].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to choose a brand. ";
    }
    else {
        spanUpdate[3].innerHTML = "";
    }
    // category
    if(category.val() == 0){
        err++;
        spanUpdate[4].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> You need to choose a category. ";
    }
    else {
        spanUpdate[4].innerHTML = "";
    }
    // photo
    var regexPhoto = /^([a-zA-Z0-9\s_\\.\-])+(.png|.jpg|.jpeg)$/;
        if((typeof document.querySelector('input[type=file]').files[0]) != "undefined"){
                if(!regexPhoto.test(document.querySelector('input[type=file]').files[0]['name'])){
                    err++;
                    spanUpdate[1].innerHTML = "<i class=\"fa-solid fa-circle-info\"></i> Photo needs to be jpg, jpeg or png. ";
                }
                else {
                    spanUpdate[1].innerHTML = "";
                }
            }
            if(err == 0){
                var modifiedPerfume = {};
                if(typeof document.querySelector('input[type=file]').files[0] != "undefined"){
                    modifiedPerfume = {
                        'namePerfume': $("#perfumeName").val(),
                        'descriptionPerfume': $("#desc").val(),
                        'brandPerfume' : $("#ddlBrandUpdate").val(),
                        'categoryPerfume': $("#ddlCategoryUpdate").val(),
                        'photo': document.querySelector('input[type=file]').files[0]['name'],
                        "highlighted":  $("input[name='highlighted']:checked").val(),
                        'id_perfume': $("#idPerfume").val(),
                        'btnUpdate': true
                    };
            }
            else {
                modifiedPerfume = {
                    'namePerfume': $("#perfumeName").val(),
                    'descriptionPerfume': $("#desc").val(),
                    'brandPerfume' : $("#ddlBrandUpdate").val(),
                    'categoryPerfume': $("#ddlCategoryUpdate").val(),
                    'photo': "",
                    "highlighted":  $("input[name='highlighted']:checked").val(),
                    'id_perfume': $("#idPerfume").val(),
                    'btnUpdate': true
                };
            }
            // console.log(newPerfume)
            ajaxCallback("models/update-perfume-data.php", "POST", modifiedPerfume, function(result){
                console.log(result);
                $("#responseUpdated").html(`${result.msg}`);
                setTimeout(function() { window.location=window.location;}, 1000);
            }, 'JSON');
        }
        
}


/*----------------------------------------------------------------------
    => PRINT PERFUMES FUNCTION - MULTIPLE USE
----------------------------------------------------------------------*/
function printPerfumes(data){
    var print = "";
    if(data.length == 0){
        print+= `<p class='my3'>Currently there is no perfumes to show. </p>`;
    }
    else {
        for(var p of data){
            // console.log(p);
            var images = p.photo_src.split("|");
            var image = images[0].trim();
        print += `
        <div class="col-xl-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-between flex-column flex-wrap mt-5 mb-5 perfume">`;
                print+= `<div class="perfume-picture">
                    <img src="images/${image}" class='img-fluid img-perfume' alt="${p.name}" />
                </div>
                <!-- name -->
                <span class="name-perfume mt-3">
                    ${p.name}
                </span>
                <!-- brand -->
                <div class="d-flex flex-row justify-content-between align-items-center">
                <span class='brand'>
                    ${p.brand_name}
                </span>
                <span class='cat mb-1 add-montez-new fs-bold'>`;
                        if(p.id_category == 1 || p.id_category == 2){
                             print+= "For " + p.category_name;
                        }
                        else{
                             print+= p.category_name;
                        }
                    print+=`<div class="line">
                        <img src="images/lines.png" class='img-fluid' alt="line" />
                    </div>
                </span>
                </div>
                <span class='price mt-1'>
                    $${p.price}
                </span>
                <div class="best_text">
                    <a href="single-perfume.php?id=${p.id_perfume}" data-id='${p.id_perfume}' class='view-more-link'>View Details</a>
                        </div>
                </div>
                `;
                }
            }
    $("#perfumes").html(print);
}
/*----------------------------------------------------------------------
    => PRINT PRICE BY PICKED MILLILITERS 
----------------------------------------------------------------------*/
function printPrice(data){
    //console.log(data)
    // console.log('tu sam')
    var html = "";
    html = `$${data}`;
    $(".pricing").html(html);
}
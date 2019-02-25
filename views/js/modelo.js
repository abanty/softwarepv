var tabla;




function init(){



// TODO: CODIGO PARA CHECKBOX DINAMICO
  $('input[type=checkbox]').change( function() {
     if($(this).prop("checked") == true){
     		$('#condicion').val('1');
     		// alert($(this).val());
     }else{
     	$('#condicion').val('0');
     	// alert($(this).val());
     }
     }
  );

  listarAc();


}

// TODO: FUNCION PARA ABRIR EL modal
function openmodal(){
  limpiarCampos();
  $('#modal-default').modal('show');
}


// TODO: FUNCION PARA LIMPIAR CAMPOS
function limpiarCampos(){

  $("#abreviatura").focus();
  $('#abreviatura').val('');
  $('#nombre').val('');
  $('#descripcion').val('');
  $('#condicion').val('1');
}

// TODO: FUNCION PARA GUARDAR Y EDITAR REGISTROS
function guardaryeditar(e){

  // e.preventDefault();

  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/modelo.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      // tabla.ajax.reload(null, false);
      // $.notify.defaults({ className: "success" });
      // $.notify.defaults({ autoHideDelay: 5000 });
      // $.notify.defaults({ style: 'bootstrap' });
      // $("#show_notify_alert").notify(datos,{ position:"left top" });
      alert(datos);

    }
  });
  limpiarCampos();
}

function listarAc(){

    tabla=$('#tbllistado').dataTable(
      {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
          "aProcessing": true, //Activamos el procesamiento del datatables
          "aServerSide": true, //Paginacion y filtrado realizados por el servidor
         dom: 'Bfrtip',         //Definimos los elementos del control de tabla
         buttons: [
                   'copyHtml5',
                   'excelHtml5',
                   'csvHtml5',
                   'pdf'
               ],
    "ajax":
        {
          url: '../ajax/modelo.php?op=listarAct',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
      "bDestroy": true,
      "iDisplayLength": 10, //Paginación
        "order": [[ 0, "asc" ]] //Ordenar (columna,orden)
    }).DataTable();

}

function listarDe(){

    tabla=$('#tbllistadoD').dataTable(
      {
          "aProcessing": true, //Activamos el procesamiento del datatables
          "aServerSide": true, //Paginacion y filtrado realizados por el servidor
         dom: 'Bfrtip',         //Definimos los elementos del control de tabla
         buttons: [
                   'copyHtml5',
                   'excelHtml5',
                   'csvHtml5',
                   'pdf'
               ],
    "ajax":
        {
          url: '../ajax/modelo.php?op=listarDes',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
      "bDestroy": true,
      "iDisplayLength": 10, //Paginación
        "order": [[ 5, "asc" ]] //Ordenar (columna,orden)
    }).DataTable();

}

function mostrar(){

}


(function() {
  // Before using it we must add the parse and format functions
  // Here is a sample implementation using moment.js
  validate.extend(validate.validators.datetime, {
    // The value is guaranteed not to be null or undefined but otherwise it
    // could be anything.
    parse: function(value, options) {
      return +moment.utc(value);
    },
    // Input is a unix timestamp
    format: function(value, options) {
      var format = options.dateOnly ? "YYYY-MM-DD" : "YYYY-MM-DD hh:mm:ss";
      return moment.utc(value).format(format);
    }
  });

  // These are the constraints used to validate the form
  var constraints = {

    nombre: {
      // You need to pick a username too
      presence: true,
      // And it must be between 3 and 20 characters long
      length: {
        minimum: 3,
        maximum: 20
      },
      format: {
        // We don't allow anything that a-z and 0-9
        pattern: "^[a-zA-Z0-9_ ]*$",
        // but we don't care if the username is uppercase or lowercase
        flags: "i",
        message: "debe tener a-z y 0-9"
      }
    },
    abreviatura: {
      // You need to pick a username too
      presence: true,
      // And it must be between 3 and 20 characters long
      length: {
        minimum: 3,
        maximum: 6
      },
      format: {
        // We don't allow anything that a-z and 0-9
        pattern: "[a-z0-9]+",
        // but we don't care if the username is uppercase or lowercase
        flags: "i",
        message: "debe tener a-z y 0-9"
      }
    },
    descripcion: {
      // You need to pick a username too
      presence: false,
      // And it must be between 3 and 20 characters long
      format: {
        // We don't allow anything that a-z and 0-9
        pattern: "^[a-zA-Z0-9_ ]*$",
        // but we don't care if the username is uppercase or lowercase
        flags: "i",
        message: "debe tener a-z y 0-9"
      }
    },
  };

  // Hook up the form so we can prevent it from being posted
  var form = document.querySelector("form#formulario");
  form.addEventListener("submit", function(ev) {
    ev.preventDefault();
    handleFormSubmit(form);
  });

  // Hook up the inputs to validate on the fly
  var inputs = document.querySelectorAll("input, textarea, select")
  for (var i = 0; i < inputs.length; ++i) {
    inputs.item(i).addEventListener("change", function(ev) {
      var errors = validate(form, constraints) || {};
      showErrorsForInput(this, errors[this.name])
    });
  }

  function handleFormSubmit(form, input) {
    // validate the form aainst the constraints
    var errors = validate(form, constraints);
    // then we update the form to reflect the results
    showErrors(form, errors || {});
    if (!errors) {
        guardaryeditar();
      // showSuccess();
    }
  }

  // Updates the inputs with the validation errors
  function showErrors(form, errors) {
    // We loop through all the inputs and show the errors for that input
    _.each(form.querySelectorAll("input[name], select[name]"), function(input) {
      // Since the errors can be null if no errors were found we need to handle
      // that
      showErrorsForInput(input, errors && errors[input.name]);
    });
  }

  // Shows the errors for a specific input
  function showErrorsForInput(input, errors) {
    // This is the root of the input
    var formGroup = closestParent(input.parentNode, "form-group-sm")
      // Find where the error messages will be insert into
      , messages = formGroup.querySelector(".messages");
    // First we remove any old messages and resets the classes
    resetFormGroup(formGroup);
    // If we have errors
    if (errors) {
      // we first mark the group has having errors
      formGroup.classList.add("has-error");
      // then we append all the errors
      _.each(errors, function(error) {
        addError(messages, error);
      });
    } else {
      // otherwise we simply mark it as success
      formGroup.classList.add("has-success");
    }
  }

  // Recusively finds the closest parent that has the specified class
  function closestParent(child, className) {
    if (!child || child == document) {
      return null;
    }
    if (child.classList.contains(className)) {
      return child;
    } else {
      return closestParent(child.parentNode, className);
    }
  }

  function resetFormGroup(formGroup) {
    // Remove the success and error classes
    formGroup.classList.remove("has-error");
    formGroup.classList.remove("has-success");
    // and remove any old messages
    _.each(formGroup.querySelectorAll(".help-block.error"), function(el) {
      el.parentNode.removeChild(el);
    });
  }

  // Adds the specified error with the following markup
  // <p class="help-block error">[message]</p>
  function addError(messages, error) {
    var block = document.createElement("p");
    block.classList.add("help-block");
    block.classList.add("error");
    block.innerText = error;
    messages.appendChild(block);
  }

  function showSuccess() {
    // We made it \:D/
    alert("Success!");
  }
})();





init();

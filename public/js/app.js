
$("#image").on("input", function() {
    $("#blog-img").attr('src','');
});

window.setTimeout(function() {
    $('.alert').hide();

}, 4000);


$(function () {
  // ON SELECTING ROW
  $(".userCredit").click(function () {

    this.id=this.id;
    var name = document.getElementById("name"+this.id).textContent;
    var credit = document.getElementById("credit"+id).textContent;
    document.getElementById('idModal1').innerHTML=id;
    document.getElementById('idModal').value=id;
    document.getElementById('nameModal').innerHTML=name;
    document.getElementById('creditModal').value=credit;

  });
});

$(function () {
    // ON SELECTING ROW
    $(".chooseDate").click(function () {

      id=this.id;

      document.getElementById('idModal').value=id;

    });
  });


  const elems = document.querySelectorAll('.datepicker_input');
  for (const elem of elems) {
    const datepicker = new Datepicker(elem, {
      'format': 'yyyy-mm-dd',

    });
  }
$(document).ready(function () {

	/*	Disables mobile keyboard from displaying when clicking +/- inputs */

	$('.input-number-decrement').attr('readonly', 'readonly');
	$('.input-number-increment').attr('readonly', 'readonly');

	/*Attributes variables with min and max values for counter*/

	var min = $(".input-number-decrement").data("min");
	var max = $(".input-number-increment").data("max");

	/*Incrementally increases the value of the counter up to max value, and ensures +/- input works when input has no value (i.e. when the input-number field has been cleared) */

	$(".input-number-increment").on('click', function () {
		var $incdec = $(this).prev();

		if ($incdec.val() == '') {
			$incdec.val(1);
		} else if ($incdec.val() < max) {
			$incdec.val(parseInt($incdec.val()) + 1);
		}
	});

	/*Incrementally decreases the value of the counter down to min value, and ensures +/- input works when input has no value (i.e. when the input-number field has been cleared) */

	$(".input-number-decrement").on('click', function () {
		var $incdec = $(this).next();

		if ($incdec.val() == '') {
			$incdec.val(0);
		} else if ($incdec.val() > min) {
			$incdec.val(parseInt($incdec.val()) - 1);
		}
	});

	/* Removes any character other than a number that is entered in number input */

	var input = document.getElementsByClassName('input-number');

	$(input).on('keyup input', function () {

		this.value = this.value.replace(/[^0-9]/g, '');

		/* Gives an error if number entered is over max */


	});

	/* Function to display error for numbers over max */


});









//


$(document).ready(function() {
	//Only needed for the filename of export files.
	//Normally set in the title tag of your page.
	document.title='Simple DataTable';
	// DataTable initialisation
	$('#example').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"columnDefs": [
				{ "orderable": false, "targets": 5 }
			],
			"buttons": [
				'colvis',
				'copyHtml5',
        'csvHtml5',
				'excelHtml5',
        'pdfHtml5',
				'print'
			]
		}
	);
	//Add row button
	$('.dt-add').each(function () {
		$(this).on('click', function(evt){
			//Create some data and insert it
			var rowData = [];
			var table = $('#example').DataTable();
			//Store next row number in array
			var info = table.page.info();
			rowData.push(info.recordsTotal+1);
			//Some description
			rowData.push('New Order');
			//Random date
			var date1 = new Date(2016,01,01);
			var date2 = new Date(2018,12,31);
			var rndDate = new Date(+date1 + Math.random() * (date2 - date1));//.toLocaleDateString();
			rowData.push(rndDate.getFullYear()+'/'+(rndDate.getMonth()+1)+'/'+rndDate.getDate());
			//Status column
			rowData.push('NEW');
			//Amount column
			rowData.push(Math.floor(Math.random() * 2000) + 1);
			//Inserting the buttons ???
			rowData.push('<button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;"><span class="fa fa-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>');
			//Looping over columns is possible
			//var colCount = table.columns()[0].length;
			//for(var i=0; i < colCount; i++){			}

			//INSERT THE ROW
			table.row.add(rowData).draw( false );
			//REMOVE EDIT AND DELETE EVENTS FROM ALL BUTTONS
			$('.dt-edit').off('click');
			$('.dt-delete').off('click');
			//CREATE NEW CLICK EVENTS
			$('.dt-edit').each(function () {
				$(this).on('click', function(evt){
					$this = $(this);
					var dtRow = $this.parents('tr');
					$('div.modal-body').innerHTML='';
					$('div.modal-body').append('Row index: '+dtRow[0].rowIndex+'<br/>');
					$('div.modal-body').append('Number of columns: '+dtRow[0].cells.length+'<br/>');
					for(var i=0; i < dtRow[0].cells.length; i++){
						$('div.modal-body').append('Cell (column, row) '+dtRow[0].cells[i]._DT_CellIndex.column+', '+dtRow[0].cells[i]._DT_CellIndex.row+' => innerHTML : '+dtRow[0].cells[i].innerHTML+'<br/>');
					}
					$('#myModal').modal('show');
				});
			});
			$('.dt-delete').each(function () {
				$(this).on('click', function(evt){
					$this = $(this);
					var dtRow = $this.parents('tr');
					if(confirm("Are you sure to delete this row?")){
						var table = $('#example').DataTable();
						table.row(dtRow[0].rowIndex-1).remove().draw( false );
					}
				});
			});
		});
	});
	//Edit row buttons

});


$(document).ready(function() {
    // проверить, есть ли вошедший в систему пользователь
    if(Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });
    }
});
function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // показываем только последние 5 уведомлений
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('No notifications ');
        $(target).removeClass('has-notifications');
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '' + notificationText + '';
}
// получить маршрут уведомления в зависимости от его типа
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    }
    return "https://habr.com/" + to;
}
// получить текст уведомления в зависимости от его типа
function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += '' + name + ' followed you';
    }
    return text;
}
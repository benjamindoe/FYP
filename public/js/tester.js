var ipcon;
var textArea = $("#text");

function resetScanner(nr, lcd)
{
	nr.requestTagID(Tinkerforge.BrickletNFCRFID.TAG_TYPE_TYPE2);
	lcd.clearDisplay();
	lcd.writeLine(0,0,'Scanner Ready');
}
function lcdWrite(lcd, message)
{
	lcd.clearDisplay();
	lcd.writeLine(0,0, message);	
}
function startScanning() {
	textArea.val('');
	var HOST = 'localhost';//$("#host").val();
	var PORT = 4280;//parseInt($("#port").val());
	var UID = 'oDk'//$("#uid").val();
	var LCDUID = 'ogf';
	if(ipcon !== undefined) {
		ipcon.disconnect();
	}
	ipcon = new Tinkerforge.IPConnection(); // Create IP connection
	var nr = new Tinkerforge.BrickletNFCRFID(UID, ipcon); // Create device object
	var lcd = new Tinkerforge.BrickletLCD20x4(LCDUID, ipcon); // Create device object
	var tagType = Tinkerforge.BrickletNFCRFID.TAG_TYPE_TYPE2;

	ipcon.connect(HOST, PORT,
		function(error) {
			textArea.val(textArea.val() + 'Error: ' + error + '\n');
		}
	); // Connect to brickd
	// Don't use device before ipcon is connected

	ipcon.on(Tinkerforge.IPConnection.CALLBACK_CONNECTED,
		function (connectReason) {
			// Start scan loop
			lcd.setCustomCharacter(0, [31,31,31,31,31,31,31,31]);
			lcd.setCustomCharacter(1, [0,16,8,4,2,1,0,0]);
			lcd.backlightOn();
			resetScanner(nr, lcd);
		}
	);

	// Register state changed callback
	nr.on(Tinkerforge.BrickletNFCRFID.CALLBACK_STATE_CHANGED,
		// Callback function for state changed callback
		function (state, idle) {
			var timer;
			if(state == Tinkerforge.BrickletNFCRFID.STATE_REQUEST_TAG_ID_READY) {
				nr.getTagID(function (tagType, tidLength, tid) {
					lcdWrite(lcd, 'Scanned');

					var s = 'Found tag of type ' + tagType +
							' with ID [';
					var tagId = '';
					for(var i = 0; i < tidLength; i++) {
						if(i !== 0)
							tagId += ' ';
						tagId += tid[i];
					}
					s += tagId + ']\n';
					textArea.val(textArea.val() + s);
					$(document).ajaxStart(function(){
						lcdWrite(lcd, 'Registering');
						turner = 0;
						timer = setInterval(function(){
							turner++;
							switch(turner % 4)
							{
								case 0:
									lcd.writeLine(0, 12, '/');
									break;
								case 1:
									lcd.writeLine(0, 12, '-');
									break;
								case 2:
									lcd.writeLine(0, 12, '\u0009');
									break;
								case 3:
									lcd.writeLine(0, 12, '|');
									break;
							}
						}, 300);
					});
					$.post('http://ec2-52-56-199-23.eu-west-2.compute.amazonaws.com/api/register',{'tagid': tagId}, function(data){
						clearInterval(timer);
						lcdWrite(lcd, 'Registered ' + data.regStudent);
						$('#student-' + data.regStudentId).val(data.code);
						console.log(data);
					}).fail(function(){
						clearInterval(timer);
						lcdWrite(lcd, 'Error Whilst Registering');
					}).always(function(){
						setTimeout(function() {
							nr.requestTagID(tagType);
						}, 1000);
					});
				},
				function (error) {
					textArea.val(textArea.val() + 'Error: ' + error + '\n');
				});
			} else if(idle) {
				resetScanner(nr, lcd);
			}
		}
	);
}
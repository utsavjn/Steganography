# Steganography
This application lets you embed or hide important or private messages or files into picture  files like JPG, GIF and BMP Bitmap images without affecting the quality of actual images or files. It achieves this by using the least significant bits of these files for embedding data which are not used by the Image viewers or Image editors.

Click on Download as ZIP and after extracting all the files open file name "Run.bat".

What's new in it

It allows you to embed the messages or files in encrypted form using 32 bit DES algorithm which means that once encrypted, the message or file could be retrieved (or decrypted) from a Master file only after specifying the correct password which was used at the time of encryption.
It allows embedding messages and files in compressed form using ZIP compression format. Gives you a choice of compression level to be used.

2. Embedding a message:
Click on 'Embed Message' button or choose File > Embed Message from the menu.
Select the Master file which will be used for embedding data into.
Select the Output file which will contain the embedded message. This file will be an a copy of master file and will containing the embedded message.
In the 'Embedding message' dialog box, Key in the message in the message box or paste a text already present on the clipboard.
Choose the options to be used while embedding message. These options include Compression and Encryption.
If you specify compression to be used, you can specify the compression level to be used between 0 to 9.
If you specify encryption to be used, you'll have to specify a password which is a minimum of 8 characters in length.
You can change the Master file or Output file by clicking on 'Change' button next to each item.
Finally when you're ready to go, click on 'Go' button.

3. Embedding a file:
Click on 'Embed File' button or choose File > Embed File from the menu.
Select the Master file which will be used for embedding data into.
Select the Output file which will contain the embedded Data file. This file will be an a copy of master file and will containing the embedded Data file.
Select the Data file which will be embedded into the master file.
In the "Embed file" dialog box, choose the options to be used while embedding the data file. These options include Compression and Encryption.
If you specify compression to be used, you can specify the compression level to be used between 0 to 9.
If you specify encryption to be used, you'll have to specify a password which is a minimum of 8 characters in length.
You can change the Master file, Output file or Data file by clicking on 'Change' button next to each item.
Finally when you're ready to go, click on 'Go' button.

 4. Retrieving message from a Master file:
 Click on 'Retrieve Message' button or choose File > Retrieve Message from the menu.
Select the Master file containing the embedded message.
A dialog box will appear summarizing the properties of the Master file. it shows you whether the file contains an embedded message or a file, Steganograph version used to embed the message/file, whether compression and encryption have been used and the compression ratio if compression has been used. It also shows you the request you have made.
Finally when you're ready to go, click on 'Go' button.
If the message is encrypted, you will be asked for the password. Key in the password and click on the OK button.
The message will be retrieved and presented to you in a text application similar to Windows notepad.

 5. Retrieving embedded file from a Master file:
Click on 'Retrieve File' button or choose File > Retrieve File from the menu.
Select the Master file containing the embedded file.
A dialog box will appear summarizing the properties of the Master file. it shows you whether the file contains an embedded message or a file, Steganograph version used to embed the message/file, whether compression and encryption have been used and the compression ratio if compression has been used. It also shows you the request you have made.
Finally when you're ready to go, click on 'Go' button.
If the file is encrypted, you will be asked for the password. Key in the password and click on the OK button.
The file will be retrieved and stored in current working directory. If it is detected that you are using a Windows platform, you will have a choice to open the file directly from the application.

 6. Obtaining help:
Click on 'About Steganograph' button or choose Help > About Steganograph from the menu..
Click on Help button in the next window.
If you notice any bugs or have any comments about the application, you could send me comments directly from the application.
To send comments, click on 'About Steganograph' button or choose Help > About Steganograph, then click on 'Send comments button'.
You could mail me at utsavj77@gmail.com

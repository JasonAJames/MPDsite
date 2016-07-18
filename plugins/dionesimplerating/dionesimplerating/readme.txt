Dione Simple Rating is free Joomla! plugin that adds the very simple rating system on your pages.
By means of this plugin you can receive to your script the information on an estimation of the users.

Features:
* Joomla 1.5 Native Extension
* Simple and fastest way to add a rating for your page
* Possibility to work like a star/unstarl
* Pure JS and PHP codes (no Flash)
* All customisations of the plugin can be customised both on the Back-End side, and in the code of your HTML-page
* Generates W3C valid XHTML and adds no JS global variables & passes JSLint
  
Used parameters:
All customisations of the Dione Color Picker can be made on the Back-End.
* targeturl   Target URL address in which will be sent the information about any rating.
* curvalue    Current value of the rating.
* maxvalue    Maximum value of the rating.

Example of usage:
For usage of the plugin you should specify on you page this template:
   {dionesimplerating id=".." parameters=".."} 
   {/dionesimplerating}

For usage of this plugin you should define the tag 'dionesimplerating' on your page.
For the option 'parameters' of the tag 'dionesimplerating' you can use all parameters, which are available on the Joomla!'s Back-End side (the description of usage of these parameters is placed above).

As you might have notice, for single star, the script works like a star/unstarl. 
For two or more stars, it works as a rating system. To value at the server end can be recieved via post variable named "rating".

Example
 If you wish to view the plugin in the basic mode use the following example. In this case you will use all defaults parameters:
  {dionesimplerating id="1" parameters=""}
  {/dionesimplerating}
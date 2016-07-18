<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript" >
function NewWindow(mypage, myname, w, h, scroll) {
 var winl = (screen.width - w) / 2;
 var wint = (screen.height - h) / 2; 
 winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
 win = window.open(mypage, myname, winprops)
 if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
</script>
<?php JHTML::stylesheet( 'xtremelocator_pub.css', '/components/com_xtremelocator/css/' );?>
<?php echo $this->loadTemplate('form'); ?>

<?php if(isset($_SESSION["xl_results"])){ 
    echo $this->loadTemplate('results');
} ?>


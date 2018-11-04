


<input class="button" type="button" name="submitcancel" value="Cancel" onclick="prepareAction(this.form,'cancel');"/>
<?php if (strpos($page_title, 'Add') === false) { ?>
<input class="button" type="button" name="submitdelete" value="Delete" onclick="prepareAction(this.form,'delete');"/>
<input class="button" type="button" name="submitmodify" value="Modify" onclick="prepareAction(this.form,'update');"/>
<?php }else{ ?>
<input class="button" type="button" name="submitsave" value="Save" onclick="prepareAction(this.form,'save');"> &nbsp;<br />
<?php }?>
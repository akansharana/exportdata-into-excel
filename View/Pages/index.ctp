<html>
<form action="<?php echo BASEURL;?>pages/export_excel" method="post">

<label>From:</label><input name="data[Page][from_id]" size="40" />

<label>To:</label><input name="data[Page][to_id]" size="40" />
<label>Date:</label><input name="data[Page][from_date]" size="40" />

<input type="submit" value="submit" />
</form>
</html>
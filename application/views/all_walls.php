<h1>Kaikki seinät ovat tässä</h1>

<ul>
<?php foreach($seinat as $seina): ?>
    <li class="wall-list">
        
        <span class="editable-span" data-id="<?php echo $seina->id; ?>">
            <?php echo $seina->nimi; ?>
        </span>

        <a class="edit-link" data-id="<?php echo $seina->id; ?>" href="#"> Edit </a>
        |
        <a href="<?php echo base_url();?>wall/delete/<?php echo $seina->id; ?>"> Delete </a>
        |
        <a class="delete-link" data-id="<?php echo $seina->id; ?>" href="#"> Delete (Ajax) </a>

    </li>
<?php endforeach; ?>
</ul>

<h2>Lisää uusi seinä</h2>

<?php echo validation_errors(); ?>

<form action="<?php echo base_url();?>wall/create" method="post" accept-charset="utf-8">
    <input type="text" name="nimi">
    <input type="submit" name="ok" value="Tallenna">
</form>

<script>
// Make editable
var editWallName = function(event) {
    var spanToEdit = event.target.parentElement.getElementsByClassName('editable-span')[0];
    spanToEdit.contentEditable = true;
    spanToEdit.focus();
    document.execCommand('selectAll',false, null);
    spanToEdit.addEventListener('keypress', saveWallName, false);
};


// Ajax-call to save span
var saveWallName = function(event) {
    
    if (event.key == 'Enter') {
        event.preventDefault();
        var id = event.target.dataset.id;
        var content = event.target.innerHTML;
        content = content.trim();
        console.log(id);
        console.log(content);
        var data = { id: id, content: content }
        console.log(data);

        // Luodaan uusi ajax-kutsu
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data.status == 'success') {
                    li.parentElement.removeChild(li);
                }
                else {
                    alert('Poistamisessa tapahtui virhe!');
                    console.log(this);
                }
            }
        };
        console.log("onko vielä data talleella")
        console.log(data);
        xmlhttp.open("PUT", ajaxSaveURL, true);
        xmlhttp.setRequestHeader("Content-Type", "application/json");
        xmlhttp.send(JSON.stringify(data));
    }
};


// Ajax-call to delete
var deleteWall = function(event) {

    // Otetaan klikatun elementin data-id talteen        
    var id = event.target.dataset.id;
    // Otetaan linkin parent-elementti talteen (li-elementti)
    var li = event.target.parentElement;

    // Luodaan uusi ajax-kutsu
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            if (data.status == 'success') {
                li.parentElement.removeChild(li);
            }
            else {
                alert('Tallennuksessa tapahtui virhe!');
                console.log(this);
            }
        }
    };
    xmlhttp.open("GET", ajaxDeleteURL+ "/" + id, true);
    xmlhttp.send();
};


// Delete classes and URL
var classname = document.getElementsByClassName("delete-link");
var ajaxDeleteURL = "<?php echo base_url(); ?>ajax/delete";

for (var i = 0; i < classname.length; i++) {
    classname[i].addEventListener('click', deleteWall, false);
}


// Edit and Save classes and URL
var editClassName = document.getElementsByClassName("edit-link");
var ajaxSaveURL = "<?php echo base_url(); ?>ajax/save";

for (var i = 0; i < editClassName.length; i++) {
    editClassName[i].addEventListener('click', editWallName, false);
}


</script>
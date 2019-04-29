<h1>Kaikki seinät ovat tässä</h1>
<p>Lista tähän kunhan db on valmis</p>

<ul>
<?php foreach($seinat as $seina): ?>
    <li>
        <?php echo $seina->nimi; ?>
        
        <a href="<?php echo base_url();?>wall/delete/<?php echo $seina->id; ?>">Poista</a>
        
        <a class="delete-link" data-id="<?php echo $seina->id; ?>" href="#">Ajax-poista</a>

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

// Ajax-call
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
                alert('Poistamisessa tapahtui virhe!');
                console.log(this);
            }
        }
    };
    xmlhttp.open("GET", ajaxURL+ "/" + id, true);
    xmlhttp.send();
};



    var classname = document.getElementsByClassName("delete-link");
    
    var ajaxURL = "<?php echo base_url(); ?>ajax/delete";

    

    for (var i = 0; i < classname.length; i++) {
        classname[i].addEventListener('click', deleteWall, false);
    }





</script>
<h1>Anna palautetta</h1>
<div>
    <?php echo validation_errors(); ?>
</div>
<form method="post" action="<?php echo base_url()?>feedback/get">
  <div class="form-group">
    <label for="email">Sähköposti</label>
    <input type="email" 
           name="email" 
           id="email" 
           value="<?php echo set_value('email'); ?>"
           class="form-control" 
           placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="grade">Arvosana</label>
    <select name="grade" id="grade" class="form-control" >
      <option value="" <?php echo  set_select('grade', ''); ?> >valitse arvosana</option>
      <option value="1" <?php echo  set_select('grade', '1'); ?> >1</option>
      <option value="2" <?php echo  set_select('grade', '2'); ?>>2</option>
      <option value="3" <?php echo  set_select('grade', '3', TRUE); ?> >3</option>
      <option value="4" <?php echo  set_select('grade', '4'); ?> >4</option>
      <option value="5" <?php echo  set_select('grade', '5'); ?>>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="feedback">Vapaa sana</label>
    <textarea name="feedback" id="feedbackInput" class="form-control" rows="3"><?php echo set_value('feedback'); ?></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Lähetä palaute">
  </div>

</form>
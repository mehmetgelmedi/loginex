<?php
	if ($this->session->has("kAdi")) {
		$this->response->redirect("");
	} ?>
<div class="panel-heading">
	<h3>Giriş Paneli</h3>
</div>

<?php
	if ($this->session->has("kAdi")) {
		$this->response->redirect();
	}
    echo $this->tag->form(
        [
            "action" => "kullanici/Giris",
            "autocomplete" => "off",
            "class" => "form-vertical"
        ]
    );
?>
<div class="form-group">
<div class="row">
	<label class="col-sm-2 control-label" for="kAdi">Kullanici Adi</label>
	<div class="col-sm-4">
		<?php echo $this->tag->textField(["kAdi","class"=>"form-control" , "id"=>"idkAdi"]); ?>
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="row">
		<label class="col-sm-2 control-label" for="parola">Parola</label>
		<div class="col-sm-4">
			<?php echo $this->tag->textField(["parola","class" => "form-control", "id" => "idparola"]); ?>
		</div>
		</div>
	</div>
<input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
        value='<?php echo $this->security->getToken() ?>'/>

<div class="form-group">
<div class="row">
<div class="form-group">
	<?php echo $this->tag->submitButton(["Giris Yap", "class" => "btn btn-default col-sm-2"]); ?>
	</div>
	</div>
</div>


<?php echo $this->tag->endForm(); ?>
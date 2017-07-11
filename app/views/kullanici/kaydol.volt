<div class="panel-heading">
	<h3>Kayit Paneli</h3>
</div>
{{ form('Kullanici/_Kaydol','method','post') }}
<div class="form-group">
<div class="row">
	<label class="col-sm-2 control-label" for="kAdi">Kullanici Adi</label>
	<div class="col-sm-4">
		<input type="text" name="kAdi" class="form-control">
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="row">
		<label class="col-sm-2 control-label" for="parola">Parola</label>
		<div class="col-sm-4">
			<input type="text" name="parola" class="form-control">
		</div>
		</div>
	</div>


<div class="form-group">
<div class="row">
<div class="form-group">
	<input type="submit" name="btn" value="Kaydol" class="btn btn-default col-sm-2">
	</div>
	</div>
</div>
{{ end_form() }}
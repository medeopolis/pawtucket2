<?php
if(!$this->request->isLoggedIn()){
	print "do redirect";
}else{
	$o_config = caGetContactConfig();
	$va_errors = $this->getVar("errors");
	$vn_num1 = rand(1,10);
	$vn_num2 = rand(1,10);
	$vn_sum = $vn_num1 + $vn_num2;
	$vs_page_title = ($o_config->get("contact_page_title")) ? $o_config->get("contact_page_title") : _t("Contact");
	
	# --- if a table has been passed this is coming from the Item Inquiry/Ask An Archivist contact form on detail pages
	$pn_id = $this->request->getParameter("id", pInteger);
	$ps_table = $this->request->getParameter("table", pString);
	
	if($pn_id && $ps_table){
		$t_item = Datamodel::getInstanceByTableName($ps_table);
		if($t_item){
			$t_item->load($pn_id);
			$vs_url = $this->request->config->get("site_host").caDetailUrl($this->request, $ps_table, $pn_id);
			$vs_name = $t_item->get($ps_table.".preferred_labels");
			$vs_idno = $t_item->get($ps_table.".idno");
			$vs_page_title = ($o_config->get("item_inquiry_page_title")) ? $o_config->get("item_inquiry_page_title") : _t("Repatriation Inquiry");
		}
	}
?>
<div class="row"><div class="col-sm-12">
	<H2 class="uk-h1"><?= $vs_page_title; ?></H2>
<?php
	if(is_array($va_errors["display_errors"]) && sizeof($va_errors["display_errors"])){
		print "<div class='alert alert-danger'>".implode("<br/>", $va_errors["display_errors"])."</div>";
	}
?>
	<form id="contactForm" action="<?= caNavUrl($this->request, "", "Contact", "send"); ?>" method="post">
	    <input type="hidden" name="csrfToken" value="<?= caGenerateCSRFToken($this->request); ?>"/>
<?php
	if($pn_id && $t_item->getPrimaryKey()){
?>
		<div class="row">
			<div class="col-sm-12">
				<p><b>Title: </b><?= $vs_name; ?>
				<br/><b>Regarding this URL: </b><a href="<?= $vs_url; ?>" class="purpleLink"><?= $vs_url; ?></a>
				</p>
				<input type="hidden" name="itemId" value="<?= $vs_idno; ?>">
				<input type="hidden" name="itemTitle" value="<?= $vs_name; ?>">
				<input type="hidden" name="itemURL" value="<?= $vs_url; ?>">
				<input type="hidden" name="id" value="<?= $pn_id; ?>">
				<input type="hidden" name="table" value="<?= $ps_table; ?>">
				<hr/><br/><br/>
	
			</div>
		</div>
<?php
	}
?>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group<?= (($va_errors["name"]) ? " has-error" : ""); ?>">
							<label for="name" class="control-label"><?= _t("Name"); ?></label>
							<input type="text" class="form-control input-sm" aria-label="enter name" placeholder="Enter name" name="name" value="{{{name}}}" id="name">
						</div>
					</div><!-- end col -->
					<div class="col-sm-6">
						<div class="form-group<?= (($va_errors["email"]) ? " has-error" : ""); ?>">
							<label for="email" class="control-label"><?= _t("Email address"); ?></label>
							<input type="text" class="form-control input-sm" id="email" placeholder="Enter email" name="email" value="{{{email}}}">
						</div>
					</div><!-- end col -->
				</div><!-- end row -->
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group<?= (($va_errors["message"]) ? " has-error" : ""); ?>">
					<label for="message" class="control-label"><?= _t("Message"); ?></label>
					<textarea class="form-control input-sm" id="message" name="message" rows="5">{{{message}}}</textarea>
				</div>
			</div><!-- end col -->
		</div><!-- end row -->
<?php
	if(!$this->request->isLoggedIn() && defined("__CA_GOOGLE_RECAPTCHA_KEY__") && __CA_GOOGLE_RECAPTCHA_KEY__){
?>
		<script type="text/javascript">
			var gCaptchaRender = function(){
                grecaptcha.render('regCaptcha', {'sitekey': '<?= __CA_GOOGLE_RECAPTCHA_KEY__; ?>'});
        	};
		</script>
		<script src='https://www.google.com/recaptcha/api.js?onload=gCaptchaRender&render=explicit' async defer></script>
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
					<div class='form-group<?= (($va_errors["recaptcha"]) ? " has-error" : ""); ?>'>
						<div id="regCaptcha" class="col-sm-8 col-sm-offset-4"></div>
					</div>
				</div>
			</div><!-- end row -->
<?php
	}
?>
		<div class="form-group">
			<button type="submit" class="uk-button uk-button-default"><?= _t("Send"); ?></button>
		</div><!-- end form-group -->
		<input type="hidden" name="sum" value="<?= $vn_sum; ?>">
	</form>
	
</div><!-- end col --></div><!-- end row -->
<?php
}
?>

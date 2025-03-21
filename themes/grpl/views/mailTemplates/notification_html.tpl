<?php
/* ----------------------------------------------------------------------
 * default/views/mailTemplates/notification_html.tpl
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2009-2011 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */

print _t("<p>Your %1 password was reset on %2 at %3. If you did not reset your password, please contact us at %4.</p>


<p>Regards,<br/>

The Grand Rapids History Center<br/>
Grand Rapids Public Library</p>

", $this->request->config->get("app_display_name"), date("F j, Y"), date("G:i"), $this->request->config->get("ca_admin_email"));


	print $this->request->config->get("site_host");
?>

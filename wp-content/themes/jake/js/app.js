/* =============================================================================
   App
   ========================================================================== */

	Banner = Ember.Application.create({

	});

/* =============================================================================
   Models
   ========================================================================== */

	Banner.Client = Ember.Object.extend({

		title  : null,
		img    : null,
		text   : null,
		logo   : null,
		study  : null,
		active : false,



	});


/* =============================================================================
   Controllers
   ========================================================================== */

	Banner.ClientsController = Ember.ArrayController.create({

		content : [],

		create : function( title, img, text, logo, study ) {
			var controller = this;
			var client     = Banner.Client.create();
			
			client.set("title", title);
			client.set("img", img);
			client.set("text", text);
			client.set("logo", logo);
			client.set("study",study);
			
			controller.pushObject( client );
		}

	});



/* =============================================================================
   Views
   ========================================================================== */



/* =============================================================================
   In the PHP Stuff
   ========================================================================== */


	var client  = Banner.ClientsController.create( "Title", "Image", "Text", "Logo", "Study" );
	var client2 = Banner.ClientsController.create( "Title 2", "Image 2", "Text 2", "Logo 2", "Study 2" );
	var last   = Banner.ClientsController.content.get( "lastObject" );

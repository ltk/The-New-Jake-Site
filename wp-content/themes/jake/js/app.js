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

		showStudy : function() {

		},

	});


/* =============================================================================
   Controllers
   ========================================================================== */

	Banner.Clients = Ember.ArrayController.create({

		content : [],
		activeIndex : 0,

		create : function( title, img, text, logo, study ) {
			var client = Banner.Client.create();
			
			client.set("title", title);
			client.set("img", img);
			client.set("text", text);
			client.set("logo", logo);
			client.set("study", study);
			
			this.pushObject( client );
		},

		activate : function( animation, client, index ) {

			animation( this.objectAtContent( this.activeIndex ), client );

			this.deactivate();
			this.set( "activeIndex", index );
			client.set( "active", true );
		},

		deactivate : function() {
			if ( this.activeIndex !== null ) {
				this.objectAtContent( this.activeIndex ).set( "active", false );
			}
		},

		previous : function() {
			if ( this.activeIndex > 0 ) {
				var prev = this.activeIndex-1;
				this.activate( this.slideRight, this.objectAtContent( prev ), prev );
			} else {
				var prev = this.content.length-1;
				this.activate( this.slideRight, this.objectAtContent( prev ), prev );
			}
		},

		next : function() {
			if ( this.activeIndex < this.content.length-1 ) {
				var next = this.activeIndex+1;
				this.activate( this.slideRight, this.objectAtContent( next ), next );
			} else {
				var next = 0;
				this.activate( this.slideRight, this.objectAtContent( next ), next );
			}
		},

		slideRight : function( outgoing, incoming ) {
			console.log( outgoing );
		}

	});



/* =============================================================================
   Views
   ========================================================================== */

	Banner.WorkView = Ember.CollectionView.create({
		tagName : "ul",
		content : Banner.Clients.content,

		// Not actually necessary
		emptyView : Ember.View.extend({
			template : Ember.Handlebars.compile("There are no clients."),
		}),


		itemViewClass : Ember.View.extend({
			templateName      : "client",
			classNameBindings : ['this.content.active'], // Auto adds ".active" if client.active == true
		}),

	});

	Banner.nextView = Ember.View.extend({
		templateName : "next-button",
		tagName : "a",
		classNames : ["scroll-right"],
		template : Ember.Handlebars.compile("Next Slide"),
		
		attributeBindings: ['href'],
			href: '#',

		click : function() {
			Banner.Clients.next();
		},
 	});

	Banner.prevView = Ember.View.extend({
		templateName : "prev-button",
		tagName : "a",
		classNames : ["scroll-left"],
		template : Ember.Handlebars.compile("Previous Slide"),
		
		attributeBindings: ['href'],
			href: '#',

		click : function() {
			Banner.Clients.previous();
		},
 	});

/* =============================================================================
   In the PHP Stuff
   ========================================================================== */


	var client  = Banner.Clients.create( "Title", "Image", "Text", "Logo", "Study" );
	var client2 = Banner.Clients.create( "Title 2", "Image 2", "Text 2", "Logo 2", "Study 2" );
	var client2 = Banner.Clients.create( "Title 3", "Image 3", "Text 3", "Logo 3", "Study 3" );

	Banner.Clients.activate( Banner.Clients.slideRight, Banner.Clients.content.get( "firstObject" ), 0 );

	//	Must have all the clients created first. Or at least one element.
	Banner.WorkView.appendTo("#featured-work");
	
	var nextButton = Banner.nextView.create();
	nextButton.appendTo("#featured-work");	
	var prevButton = Banner.prevView.create();
	prevButton.appendTo("#featured-work");


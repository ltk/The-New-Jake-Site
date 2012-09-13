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
		name   : null,
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
			var name   = title.replace(" ", "-");

			client.setProperties({
				"name"  : name,
				"title" : title,
				"img"   : img,
				"text"  : text,
				"logo"  : logo,
				"study" : study,
			});
			
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

		previous : function( view ) {
			if ( this.activeIndex > 0 ) {
				var prev = this.activeIndex-1;
				this.activate( this.slideRight, this.objectAtContent( prev ), prev );
			} else {
				var prev = this.content.length-1;
				this.activate( this.slideRight, this.objectAtContent( prev ), prev );
			}
		},

		next : function( view ) {
			if ( this.activeIndex < this.content.length-1 ) {
				var next = this.activeIndex+1;
				this.activate( this.slideRight, this.objectAtContent( next ), next );
			} else {
				var next = 0;
				this.activate( this.slideRight, this.objectAtContent( next ), next );
			}
		},

		slideRight : function( outgoing, incoming ) {

			// position incoming to the right of outgoing
			// slide outgoing and incoming to the right
			// move outgoing somewhere.

			var outgoingDom = $("."+outgoing.name);
			var incomingDom = $("."+incoming.name);

			outgoingDom.css("position", "relative");
			incomingDom.css("position", "relative");
			
			outgoingDom.animate({ left: 0});
			incomingDom.animate({ left: 200});

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
			classNameBindings : ['this.content.active', 'this.content.name'],

		}),

	});

	Banner.LogoView = Ember.CollectionView.create({

	});

	Banner.nextView = Ember.View.extend({
		templateName : "next-button",
		tagName : "a",
		classNames : ["scroll-right"],
		
		click : function() {
			Banner.Clients.next();
		},
 	});

	Banner.prevView = Ember.View.extend({
		templateName : "prev-button",
		tagName : "a",
		classNames : ["scroll-left"],

		click : function() {
			Banner.Clients.previous();
		},
 	});

/* =============================================================================
   In the PHP Stuff
   ========================================================================== */


	var client  = Banner.Clients.create( "Title A", "Image A", "Text A", "Logo A", "Study A" );
	var client2 = Banner.Clients.create( "Title B", "Image B", "Text B", "Logo B", "Study B" );
	var client2 = Banner.Clients.create( "Title C", "Image C", "Text C", "Logo C", "Study C" );

	Banner.Clients.activate( Banner.Clients.slideRight, Banner.Clients.content.get( "firstObject" ), 0 );


/* =============================================================================
   Adding to the Dom
   ========================================================================== */

	Banner.WorkView.appendTo("#featured-work");
	
	var nextButton = Banner.nextView.create();
	nextButton.appendTo("#featured-work");	
	
	var prevButton = Banner.prevView.create();
	prevButton.appendTo("#featured-work");


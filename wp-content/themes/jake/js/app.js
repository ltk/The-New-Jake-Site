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
		
		activeIndex: function() {
			return this.indexOf( this.filterProperty('active', true)[0] );
		}.property('@each.active'),

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

		activate : function( client ) {
			// if (client !== undefined) {
				// this.deactivate();
				client.set( "active", true );
			// }
		},

		deactivate : function() {
			if ( this.get("activeIndex") !== -1 ) {
				this.objectAtContent( this.get("activeIndex") ).set( "active", false );
			}
		},


		prev : function( ) {
			alert("test")
		},

		next : function( ) {
			alert("testing")
		},

	});



/* =============================================================================
   Views
   ========================================================================== */

	Banner.scrollButtonsView = Ember.View.extend({
		tagName     : "a",
		// clickAction : Banner.Clients.next(),
		// click : function() {
		// 	clickAction();
		// },
 	});

	Banner.listsView = Ember.CollectionView.extend({
		tagName : "ul",
		content : Banner.Clients.content,

		itemViewClass : Ember.View.extend({
			classNameBindings : ['this.content.active'],
			templateName : function() {
				return this.get("parentView").get("listItemTemplate");
			}.property("this.get('parentView').listItemTemplate"),
		}),
	});

	Banner.Container = Ember.ContainerView.create({

		childViews: ['works', 'logos', 'nextButton', 'prevButton'],

		works : Banner.listsView.create({
			listItemTemplate : "works"
		}),

		logos : Banner.listsView.create({
			listItemTemplate : "logos"
		}),

		nextButton : Banner.scrollButtonsView.create({ 
			classNames : 'scroll-right', 
			template   : Ember.Handlebars.compile("Go to Next Slide"),
			click      : function() { Banner.Clients.next() },
		}),

		prevButton : Banner.scrollButtonsView.create({ 
			classNames : 'scroll-left', 
			template   : Ember.Handlebars.compile("Go to Previous Slide"),
			click      : function() { Banner.Clients.prev() },
		}),


	});





/* =============================================================================
   In the PHP Stuff
   ========================================================================== */


	var client  = Banner.Clients.create( "Title A", "Image A", "Text A", "Logo A", "Study A" );
	var client2 = Banner.Clients.create( "Title B", "Image B", "Text B", "Logo B", "Study B" );
	var client2 = Banner.Clients.create( "Title C", "Image C", "Text C", "Logo C", "Study C" );

/* =============================================================================
   Initalization
   ========================================================================== */


	Banner.Clients.activate( Banner.Clients.content.get( "firstObject" ) );

	Banner.Container.appendTo("#featured-work");


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
			return this.indexOf( this.filterProperty('active')[0] );
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
				this.deactivate();
				client.set( "active", true );
			// }
		},

		deactivate : function() {
			if ( this.get("activeIndex") !== -1 ) {
				this.objectAtContent( this.get("activeIndex") ).set( "active", false );
			}
		},

		getActive : function() {
			var active = this.get("activeIndex")
			this.objectAtContent( active );
		},

		getNext : function( ) {
			var active = this.get("activeIndex")
			if (  active < this.get("length") - 1 ) {
				return this.objectAtContent( active + 1 );
			} else {
				return this.get( "firstObject" );
			}
		},

		getPrev : function( ) {
			var active = this.get("activeIndex")
			if (  active > 0 ) {
				return this.objectAtContent( active - 1 );
			} else {
				return this.get( "lastObject" );
			}
		},

		_getNextView : function( view ) {
			var active = this.get("activeIndex");
			var views  = this._getViews( view );
			var length = views.get("length") - 1;
			
			if ( active < length ) {
				return views[ active + 1 ];
			} else {
				return views[ 0 ];
			}
		},

		_getPrevView : function( view ) {
			var active = this.get("activeIndex")
			var views  = this._getViews( view );
			var length = views.get("length") - 1;

			if (  active > 0 ) {
				return views[ active - 1 ];
			} else {
				return views[ length ];
			}
		},

		_getActiveView : function( view ) {
			var active = this.get("activeIndex")
			var views  = this._getViews( view );

			return views[ active ];
		},


		getView : function( view, state ){
			switch( state ){
				case 'next' :
					return this._getNextView( view );
					break;
				case 'prev' :
					return this._getPrevView( view );
					break;
				case 'active' :
					return this._getActiveView( view );
					break;
			}
		},

		_getViews : function( view ) {
			return Banner.Container.get( view ).get("childViews");
		},


	});



/* =============================================================================
   Views
   ========================================================================== */

	Banner.scrollButtonsView = Ember.View.extend({
		tagName     : "a",

 	});

	Banner.listsView = Ember.CollectionView.extend({
		tagName : "ul",
		content : Banner.Clients.content,

		itemViewClass : Ember.View.extend({
			classNameBindings : ['this.content.active'],
			templateName : function() {
				return this.get("parentView").get("listItemTemplate");
			}.property("this.get('parentView').listItemTemplate"),

			slideLeft :  function() {
				this.$().css("position", "relative")
					.animate({ left : -100});
			},

			slideRight : function() {
				this.$().css("position", "relative")
					.animate({ left : 100});
			},

			positionLeft : function() {
				this.$().css("position", "relative")
					.animate({ left : -200});
			},

			positionRight : function() {
				this.$().css("position", "relative")
					.animate({ left : 200});
			},
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
			
			click : function() {
				var outgoingView = Banner.Clients.getView( "works", "active" );
				var incomingView = Banner.Clients.getView( "works", "next" );
				
				outgoingView.slideLeft();
				incomingView.slideRight();

				Banner.Clients.activate( Banner.Clients.getNext() );

			},
		}),

		prevButton : Banner.scrollButtonsView.create({ 
			classNames : 'scroll-left', 
			template   : Ember.Handlebars.compile("Go to Previous Slide"),
			
			click : function() {
				var outgoingView = Banner.Clients.getView( "works", "active" );
				var incomingView = Banner.Clients.getView( "works", "prev" );
				
				outgoingView.slideLeft();
				incomingView.slideRight();

				Banner.Clients.activate( Banner.Clients.getPrev() );


			},
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


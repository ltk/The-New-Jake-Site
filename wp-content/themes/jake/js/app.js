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
			var views  = this._getChildViews( view );
			var length = views.get("length") - 1;
			
			if ( active < length ) {
				return views[ active + 1 ];
			} else {
				return views[ 0 ];
			}
		},

		_getPrevView : function( view ) {
			var active = this.get("activeIndex")
			var views  = this._getChildViews( view );
			var length = views.get("length") - 1;

			if (  active > 0 ) {
				return views[ active - 1 ];
			} else {
				return views[ length ];
			}
		},

		_getActiveView : function( view ) {
			var active = this.get("activeIndex")
			var views  = this._getChildViews( view );

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
				case 'arbitrary' :
					return this._getClientFromView( view );
					break;
			}
		},

		_getChildViews : function( view ) {
			return Banner.Container.get( view ).get("childViews");
		},

		_getView : function( view ) {
			return Banner.Container.get( view );	
		},

		_getClientFromView : function( view ) {
			return this._getClientAtIndex( view );
		},

		_getClientAtIndex : function( view ) {
			var index = view.get('contentIndex');
			return this.objectAtContent( index );
		},

		getMatchingView : function( view, viewType ) {
			var views  = this._getChildViews( viewType );
			var index  = view.get('contentIndex');
			return views[ index ];
		},

		isActiveView : function( view ) {
			var client = this._getClientFromView( view );
			if ( client.get( "active" ) ) {
				return true;
			} else {
				return false;
			}

		},

		handleClick : function ( view, direction ) {
			var controller = this;
			var duration = view.get('animation_duration');

			var outgoingWork = this.getView( "works", "active" );
			var outgoingLogo = this.getView( "logos", "active" );
			
			if ( direction == "arbitrary" ) {
				var incomingWork = this.getMatchingView( view, "works" );
				var incomingLogo = view;
			} else {
				var incomingWork = this.getView( "works", direction );
				var incomingLogo = this.getView( "logos", direction );
			}

			var highlightView = this._getView( "logoHighlight" );


			if( ! incomingWork.$().hasClass( 'animating' ) ) {

				highlightView.slide( incomingLogo, duration );

				if( direction == 'prev' ) {
					incomingWork.positionLeft( duration );		
					outgoingWork.slideRight( duration );
					incomingWork.slideRight( duration );
				} else if( direction == 'next' ){
					incomingWork.positionRight( duration );
					outgoingWork.slideLeft( duration );
					incomingWork.slideLeft( duration );
				} else if( direction == 'arbitrary' ) {
					outgoingWork.fadeOut( duration );
					incomingWork.fadeIn( duration );
				}

				var delay = setTimeout( function() {
					if( direction == 'prev' ) {
						controller.activate( controller.getPrev() );
					} else if( direction == 'next' ){
						controller.activate( controller.getNext() );
					} else if( direction == 'arbitrary' ) {
						controller.activate( controller._getClientAtIndex( view ) );
					}
				}, duration);
			}
		},




	});



/* =============================================================================
   Views
   ========================================================================== */

	Banner.scrollButtonsView = Ember.View.extend({
		tagName     : "a",
		animation_duration : 700
 	});

	Banner.Container = Ember.ContainerView.create({

		childViews: ['works', 'logos', 'nextButton', 'prevButton', 'logoHighlight'],
		elementId : "featured-work",

		works : Ember.CollectionView.extend({
			tagName : "ul",
			content : Banner.Clients.content,
			elementId : "works",

			itemViewClass : Ember.View.extend({
				classNameBindings : ['this.content.active', 'this.content.name'],
				templateName : "works",

				slideLeft :  function( duration ) {
					var windowWidth = $(window).outerWidth();
					var leftOffset  = parseInt( this.$().css("left") );

					this.$()
						.addClass('animating')
						.animate({ left : leftOffset - windowWidth }, duration, function(){
							$(this).removeClass("animating").removeAttr('style');
						});				
				},

				slideRight : function( duration ) {
					var windowWidth = $(window).outerWidth();
					var leftOffset  = parseInt( this.$().css("left") );

					this.$()
						.addClass('animating')
						.animate({ left : leftOffset + windowWidth }, duration , function(){
							$(this).removeClass("animating").removeAttr('style');
						});
				},

				positionLeft : function() {
					var windowWidth = $(window).outerWidth();

					this.$()
						.css({
							left : -windowWidth
						});
				},

				positionRight : function() {
					var windowWidth = $(window).outerWidth();

					this.$()
						.css({
							left : windowWidth
						});
				},

				fadeOut :  function( duration ) {
					this.$()
						.addClass('animating')
						.css({ 'opacity' : 1 })
						.animate({ opacity : 0 }, duration , function(){
							$(this).removeClass("animating").removeAttr('style');
						});		
				},

				fadeIn : function( duration ) {
					this.$()
						.addClass('animating')
						.css({ 'opacity' : 0 })
						.animate({ opacity : 1 }, duration , function(){
							$(this).removeClass("animating").removeAttr('style');
						});
				},			

			}),
		}),

		logos : Ember.CollectionView.extend({
			tagName : "ul",
			content : Banner.Clients.content,
			elementId : "logos",
			animation_duration : 1000,

			itemViewClass : Ember.View.extend({
				classNameBindings : ['this.content.active', 'this.content.name'],
				templateName : "logos",

				click : function() {
					if ( ! Banner.Clients.isActiveView( this ) ) {
						Banner.Clients.handleClick( this, 'arbitrary' );
					}
				}
			}),
		}),

		logoHighlight : Ember.View.create({
			tagName   : 'span',
			elementId : 'logo-highlight',
			template  : Ember.Handlebars.compile("Now Showing"),

			didInsertElement : function() {
				this.slide( Banner.Clients._getActiveView( "logos" ), 0 );
			},
			
			slide : function( incoming, duration ) {
				var newPosition = incoming.$().position().left;
				var newWidth    = incoming.$().outerWidth();

				this.$()
					.animate({
						left  : newPosition,
						width : newWidth
					}, duration);
			}
		}),

		nextButton : Banner.scrollButtonsView.create({ 
			classNames : 'scroll-right', 
			template   : Ember.Handlebars.compile("Go to Next Slide"),
			
			click : function() {
				Banner.Clients.handleClick( this, 'next' );
			},
		}),

		prevButton : Banner.scrollButtonsView.create({ 
			classNames : 'scroll-left', 
			template   : Ember.Handlebars.compile("Go to Previous Slide"),

			click : function() {
				Banner.Clients.handleClick( this, 'prev' );
			},
		}),


	});





/* =============================================================================
   In the PHP Stuff
   ========================================================================== */


	var client  = Banner.Clients.create( "ENCORE DESIGN", "The Kennedy Center", "Designing peer-to-peer marketing tools for our nation's leading performing arts center.", "Logo A", "Study A" );
	var client2 = Banner.Clients.create( "Title B", "Elgin Butler", "Text B", "Logo B", "Study B" );
	var client2 = Banner.Clients.create( "Title C", "Image C", "Text C", "Logo C", "Study C" );

/* =============================================================================
   Initalization
   ========================================================================== */


	Banner.Clients.activate( Banner.Clients.content.get( "firstObject" ) );

	$(function() {
		
	});


	// Banner.Container.replaceIn("#featured-work"); 
	$(document).keydown(function(e){
		if (e.keyCode == 37 || e.keyCode == 38) { 
			 $('a.scroll-left').click();
			 return false;
		}
		if (e.keyCode == 39 || e.keyCode == 40) { 
			$('a.scroll-right').click();
			return false;
			
		}
	});


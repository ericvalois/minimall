/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

( function( $ ) {
    
        // Site title and description.
        wp.customize( 'blogname', function( value ) {
            value.bind( function( to ) {
                $( '.site-title a' ).text( to );
            } );
        } );
        wp.customize( 'blogdescription', function( value ) {
            value.bind( function( to ) {
                $( '.site-description' ).text( to );
            } );
        } );

    } )( jQuery );    
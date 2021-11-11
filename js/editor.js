wp.domReady( () => {
    wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
    wp.blocks.unregisterBlockStyle( 'core/button', 'wanderlust' );
    
    wp.blocks.registerBlockStyle( 'core/button', [ 
        {
            name: 'default',
            label: 'Default',
            isDefault: false,
        }        
    ]);

    wp.blocks.registerBlockStyle( 'core/button', [
    	{
	        name: 'qbuttonred',
	        label: 'Q Button Red',
	        isDefault: true,
            style_handle: 'red-button'
    	}
    ]);
    wp.blocks.registerBlockStyle( 'core/button', [
        {
            name: 'qbuttonblack',
            label: 'Q Button Black',
            isDefault: false,
            style_handle: 'black-button'
        }
    ]);
    wp.blocks.registerBlockStyle( 'core/button', [
        {
            name: 'qbuttonyellow',
            label: 'Q Button Yellow',
            isDefault: false,
            style_handle: 'yellow-button'
        }
    ]);
} );
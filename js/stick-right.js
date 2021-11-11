/*var el = wp.element.createElement;
var __ = wp.i18n.__;
var registerPlugin = wp.plugins.registerPlugin;
var PluginPostStatusInfo = wp.editPost.PluginPostStatusInfo;
var CheckboxControl = wp.components.CheckboxControl;
const { withSelect, withDispatch } = wp.data;

function MyPostStatusInfoPlugin({}) {    
    //const checked = useState( true );
    const attributes = {
        qcity_custom_stick_right: {
            type: 'boolean',
            default: false
        }
    }
    return el(
            PluginPostStatusInfo,
        {
            className: 'qcity-custom-stick-right'
        },
        el(
            CheckboxControl,
            {
                name: 'qcity_custom_stick_right',
                label: __( 'Stick On Right Side' ), 
                value: "1",
                //checked: { attributes.qcity_custom_stick_right },
                onChange: { setChecked }           
            }
        )
    );
}

function setChecked( val )
{
    console.log('Checkbox checked!');
}

registerPlugin( 'my-post-status-info-plugin', {
    render: MyPostStatusInfoPlugin
} );
*/
const { CheckboxControl, withInstanceId } = wp.components
const { PluginPostStatusInfo } = wp.editPost
const { compose } = wp.element
const { withSelect, withDispatch } = wp.data
const { registerPlugin } = wp.plugins

const Render = ({ isChecked = false, updateCheck, instanceId }) => {
  const callback = () => updateCheck(!isChecked);
  const id = instanceId + '-stick-right';
  return ( 
        <PluginPostStatusInfo>
            <CheckboxControl
                        label={ __( 'Stick On Right Side', 'stick-on-right-side' ) }
                        checked={ isChecked }
                        onChange={ callback }
                        id={id}
                />      
        </PluginPostStatusInfo>       
  );
}

const RightSide = compose(
  [
    withSelect((select) => {
      return {
        isChecked: select('core/editor').getEditedPostAttribute('meta').qcity_custom_stick_right
      }
    }),
    withDispatch((dispatch) => {
      return {
        updateCheck (editors_pick) {
          dispatch('core/editor').editPost({ meta: { qcity_custom_stick_right } })
        }
      }
    }
    ),
    withInstanceId
  ]
)(Render)

registerPlugin('qcity-stick-side', {
  render: RightSide
})
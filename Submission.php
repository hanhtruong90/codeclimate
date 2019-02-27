<?php
namespace App\Nova\Metrics;
namespace App\Nova;
use Fourstacks\NovaRepeatableFields\Repeater;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Avatar;
use Illuminate\Http\Request;
use Arsenaltech\NovaHeader\NovaHeader;
use Laravel\Nova\Http\Requests\NovaRequest;
use Arsenaltech\NovaTab\NovaTab;
use Laravel\Nova\Fields\BelongsTo;
use App\Doctor;
use App\Patient;
use App\BeforeAfterImage;
use Yassi\NestedForm\NestedForm;
use Illuminate\Support\Facades\Storage;
class Submission extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Submission';

   

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     return $query->join("doctors","doctors.id","submissions.doctor_id")->select("doctors.firstname");
    // }
 

    public function fields(Request $request) 
    {
        return [
            new NovaTab('Request Form', $this->requestForm()),
            new NovaTab('Before and After Photos', $this->beforeAndAfterImagesDetails()),
            new NovaTab('Treatment used', $this->treatmentUsed()),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
   
    public function requestForm() {
		return [
            ID::make()->sortable(), 
            BelongsTo::make('Doctor', 'doctor', 'App\Nova\Doctor'),
            BelongsTo::make('Patient', 'patient', 'App\Nova\Patient'),
            BelongsTo::make('BeforeAfterImage', 'images', 'App\Nova\BeforeAfterImage'),
            Text::make('Submission date', function () { if($this->created_at)  return $this->created_at->format('d/m/Y H:m');  })->exceptOnForms(),
            Text::make('Status', function () { if($this->status)  return $this->status;  })->exceptOnForms(),
            Textarea::make('Addition Infomation','addition_infomation'),  
            
		]; 
    } 

    

    public function beforeAndAfterImagesDetails() { 
        return [NovaHeader::make('Before')->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        Image::make('Left Profile', 'before_left_profile')->thumbnail(function () {
            if($this->images) {
                return Storage::url($this->images->first()->before_left_profile);
            }
            
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        Image::make('Frontal', 'before_frontal')->thumbnail(function () {
            if($this->images) {
                return Storage::url($this->images->first()->before_frontal);
            }
           
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        Image::make( 'Right Oblique', 'before_right_oblique')->thumbnail(function () {
            if($this->images) {
                return Storage::url($this->images->first()->before_right_oblique);
            }
           
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        NovaHeader::make('After')->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),  
        Image::make( 'Left Profile', 'after_left_profile')->thumbnail(function () {
            if($this->images) {
                return Storage::url($this->images->first()->after_left_profile);
            }
           
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        Image::make( 'Frontal', 'after_frontal')->thumbnail(function () {
            if($this->images) {
                return Storage::url($this->images->first()->after_frontal);
            }
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
        Image::make( 'Right Oblique', 'after_right_oblique')->thumbnail(function () {
            if($this->images) { 
                return Storage::url($this->images->first()->after_right_oblique);
            }
            
        })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(), ];
    }   

   
        

   
    public function treatmentUsed() {
        return [
			Repeater::make('Treatment used','treatment_used')->displayStackedForm()
				->addField([ 
                    'options' => \App\Submission::$location,
                    'placeholder' => 'Location', 
                    'label' => 'Location',
                    'name' => 'location',
                    'type' => 'select',
                ]) 
                ->addField([ 
                    'options' => \App\Submission::$treatmentarea,
                    'placeholder' => 'Treatment Area', 
                    'label' => 'Treatment Area',
                    'name' => 'treatment_area',
                    'type' => 'select'
                   
                ])
                ->addField([  
                    'options' => \App\Submission::$product,
                    'placeholder' => 'Product', 
                    'label' => 'Product',
                    'name' => 'product',
                    'type' => 'select'
                    
                ])
                ->addField([
					'label' => 'How much',
					'name' => 'qty',
                ])->initialRows(1)  
                 
		]; 
       
    }
     
    
    
    public function cards(Request $request)
    {
        return [new Metrics\Submission];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        //return [];
        return [new \App\Nova\Filters\StatusSubmision];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

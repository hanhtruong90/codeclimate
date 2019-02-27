<?php
namespace App\Nova;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Arsenaltech\NovaHeader\NovaHeader;
class BeforeAfterImage extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\BeforeAfterImage';

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            NovaHeader::make('Before'),
            Image::make('Left Profile', 'before_left_profile')->disk('public') ->path('uploads')->rules('required'),
            Image::make('Frontal', 'before_frontal')->disk('public') ->path('uploads')->rules('required'),
            Image::make( 'Right Oblique', 'before_right_oblique')->disk('public') ->path('uploads')->rules('required'),
            NovaHeader::make('After'),  
            Image::make( 'Left Profile', 'after_left_profile')->disk('public') ->path('uploads')->rules('required'),
            Image::make( 'Frontal', 'after_frontal')->disk('public') ->path('uploads')->rules('required'),
            Image::make( 'Right Oblique', 'after_right_oblique')->disk('public') ->path('uploads')->rules('required'),
        ];
    } 

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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

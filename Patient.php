<?php

namespace App\Nova;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\File;

class Patient extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Patient';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'firstname';

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
            Text::make('First name','firstname')->rules('required'),  
            Text::make('Family name','familyname')->rules('required'),    
            Select::make('Age', 'age')->options(\App\Doctor::generateListAge())->rules('required'),
            Select::make('Gender', 'gender')->options(\App\Doctor::$gender)->rules('required'),
            Select::make('Smoker', 'smoker')->options(\App\Doctor::$smoker)->rules('required'),
            Select::make('Drinker', 'drinker')->options(\App\Doctor::$drinker)->rules('required'),
            Select::make('Race', 'race')->options(\App\Doctor::$race)->rules('required'),
            File::make('Consent Form','consent_form')->disk('public') ->path('uploads')
            
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

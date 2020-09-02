<?php

namespace App\Models;

use App\Models\Helper;

class ModuelDetails extends Helper
{
    protected $table = "moduels_details";
    public static $FieldsFarm=[
        'lat',
        'lng',
        'address',
        'area',
        'fossils_count',
        'north',
        'south',
        'east',
        'west',
    ];
    public static $FieldsEquipments=[
        'date_of_purchase',
        'power',
        'consumption_rate',
        'production_rate',
        'depreciation_rate',
        'model',
        'note',
    ];
    public static $FieldsWells=[
        'locations',
        'depth',
        'well_radius',
        'cost',
        'minimum_water_quantity',
        'geological_profile_date',
        'water_quantity_num',
        'water_quantity_term',
        'water_quantity_date',
        'water_analysis_file',
        'water_analysis_date',
        'recommendation',
        'note',
    ];
    public static $FieldsJura=[
        'drilling_start_date',
        'drilling_end_date',
        'replacement_start_date',
        'replacement_end_date',
        'service_start_date',
        'service_end_date',
        'service_matrial_id',
        'service_matrial_qyt',
        'service_way',
        'landfill_start_date',
        'landfill_end_date',
        'clean_start_date',
        'clean_end_date',
        'clean_water_qyt',
        'clean_repet',
        'clean_duration',
        'cleansing_start_date',
        'cleansing_end_date',
        'cleansing_matrial_id',
        'cleansing_matrial_qyt',
    ];
    public static $FieldsPlanting=[
        'planting_num_palm_trees',
        'irrigation_location',
        'irrigation_implementation',
        'irrigation_num_palm_trees',
        'irrigation_start_date',
        'irrigation_end_date',
        'protection_row',
        'protection_column',
        'protection_palm_trees',
        'protection_pesticide',
        'protection_start_date',
        'protection_end_date',
        'protection_palm_qyt',
        'protection_implementation',
        'protection_total_amount',
        'protection_how_to_use',
        'fertilization_start_date',
        'fertilization_end_date',
        'fertilization_row',
        'fertilization_column',
        'fertilization_fertilizer',
        'fertilization_palm_qyt',
        'fertilization_implementation',
        'fertilization_how_to_use',
    ];
}

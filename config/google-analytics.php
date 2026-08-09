<?php

return [

    /**
     * Service Account & Property
     */
    'service_account_credentials_json' => storage_path('app/analytics/service-account-credentials.json'),
    'property_id' => env('ANALYTICS_PROPERTY_ID'),

    /**
     * Dashboard Settings
     */
    'dedicated_dashboard' => true,
    'dashboard_icon' => 'heroicon-m-chart-bar',
    'filament_dashboard' => true,

    /**
     * Widgets Configuration
     *
     * - 'filament_dashboard': Symmetrical summary on main admin homepage (/pci).
     * - 'global': All 11 comprehensive widgets on the dedicated Google Analytics page (/pci/google-analytics-dashboard).
     */

    // --- Stats Overview Row (3 Symmetrical Cards) ---
    'page_views' => [
        'filament_dashboard' => true,
        'global' => true,
    ],
    'visitors' => [
        'filament_dashboard' => true,
        'global' => true,
    ],
    'sessions' => [
        'filament_dashboard' => true,
        'global' => true,
    ],

    // --- Charts Row (2 Side-by-Side Charts) ---
    'sessions_by_device' => [
        'filament_dashboard' => true,
        'global' => true,
    ],
    'sessions_by_country' => [
        'filament_dashboard' => true,
        'global' => true,
    ],

    // --- Tables Row (2 Side-by-Side Tables) ---
    'most_visited_pages' => [
        'filament_dashboard' => true,
        'global' => true,
    ],
    'top_referrers_list' => [
        'filament_dashboard' => true,
        'global' => true,
    ],

    // --- Additional Deep-Dive Analytics (Dedicated GA Page Only) ---
    'sessions_duration' => [
        'filament_dashboard' => false,
        'global' => true,
    ],
    'active_users_one_day' => [
        'filament_dashboard' => false,
        'global' => true,
    ],
    'active_users_seven_day' => [
        'filament_dashboard' => false,
        'global' => true,
    ],
    'active_users_twenty_eight_day' => [
        'filament_dashboard' => false,
        'global' => true,
    ],

    /**
     * Trajectory Icons
     */
    'trending_up_icon' => 'heroicon-o-arrow-trending-up',
    'trending_down_icon' => 'heroicon-o-arrow-trending-down',
    'trending_steady_icon' => 'heroicon-o-arrows-right-left',

    /**
     * Trajectory Colors
     */
    'trending_up_color' => 'success',
    'trending_down_color' => 'danger',
    'trending_steady_color' => 'gray',
];




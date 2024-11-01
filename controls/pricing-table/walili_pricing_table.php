<?php

namespace Walili\Widgets;
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Repeater;
use \Elementor\Widget_Base;


class walili_pricing_table extends Widget_Base{

  public function __construct($data = [], $args = null) {
     parent::__construct($data, $args);
  }

  //public function get_script_depends() {
    //return [ 'walili-pricing-table-script' ];
  //}

  public function get_style_depends() {
    return [ 'walili-pricing-table-stylesheet' ];
  }

  public function get_name(){
    return 'walili-pricing-table';
  }

  public function get_title(){
    return 'Pricing Table';
  }

  public function get_icon(){
    return 'fas fa-table';
  }

  public function get_categories(){
    return ['walili'];
  }

  public function get_keywords()
{
    return [
        'price menu',
        'pricing',
        'price',
        'price table',
        'table',
        'pricing table',
        'comparison table',
        'pricing plan',
        'dynamic price',
        'woocommerce pricing',
    ];
}

  protected function _register_controls(){

    $this->start_controls_section(
      'walili_pricing_table_settings_section',
      [
        'label' => 'Header',
      ]
    );

    $this->add_control(
    'pricing_table_title',
    [
        'label'       => esc_html__('Title', 'walili'),
        'type'        => Controls_Manager::TEXT,
        'dynamic' => [
            'active' => true,
        ],
        'label_block' => false,
        'default'     => esc_html__('Startup', 'walili'),
    ]
   );

   $this->add_control(
       'pricing_table_sub_title',
       [
           'label'       => esc_html__('Sub Title', 'walili'),
           'type'        => Controls_Manager::TEXT,
           'dynamic' => [
               'active' => true,
           ],
           'label_block' => false,
           'default'     => esc_html__('A tagline here.', 'walili'),
       ]
   );

   $this->end_controls_section();

   $this->start_controls_section(
       'pricing_table_price_section',
       [
           'label' => esc_html__('Price', 'walili'),
       ]
   );

   $this->add_control(
    'pricing_table_price',
    [
        'label'       => esc_html__('Price', 'walili'),
        'type'        => Controls_Manager::TEXT,
        'dynamic'               => [
            'active'       => true,
        ],
        'label_block' => false,
        'default'     => esc_html__('99', 'walili'),
        ]
    );
    $this->add_control(
        'pricing_table_onsale',
        [
            'label'        => __('On Sale?', 'walili'),
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'no',
            'label_on'     => __('Yes', 'walili'),
            'label_off'    => __('No', 'walili'),
            'return_value' => 'yes',
        ]
    );
    $this->add_control(
        'pricing_table_onsale_price',
        [
            'label'       => esc_html__('Sale Price', 'walili'),
            'type'        => Controls_Manager::TEXT,
            'dynamic'               => [
                'active'       => true,
            ],
            'label_block' => false,
            'default'     => esc_html__('89', 'walili'),
            'condition'   => [
                'pricing_table_onsale' => 'yes',
            ],
        ]
    );
    $this->add_control(
        'pricing_table_price_currency',
        [
            'label'       => esc_html__('Price Currency', 'walili'),
            'type'        => Controls_Manager::TEXT,
            'dynamic' => ['active' => true],
            'label_block' => false,
            'default'     => esc_html__('$', 'walili'),
        ]
    );

    $this->add_control(
        'pricing_table_price_currency_placement',
        [
            'label'       => esc_html__('Currency Placement', 'walili'),
            'type'        => Controls_Manager::SELECT,
            'default'     => 'left',
            'label_block' => false,
            'options'     => [
                'left'  => esc_html__('Left', 'walili'),
                'right' => esc_html__('Right', 'walili'),
            ],
        ]
    );

   $this->add_control(
    'pricing_table_price_period',
    [
        'label'       => esc_html__('Price Period (per)', 'walili'),
        'type'        => Controls_Manager::TEXT,
        'dynamic' => ['active' => true],
        'label_block' => false,
        'default'     => esc_html__('month', 'walili'),
    ]
    );

    $this->add_control(
        'pricing_table_period_separator',
        [
            'label'       => esc_html__('Period Separator', 'walili'),
            'type'        => Controls_Manager::TEXT,
            'dynamic' => ['active' => true],
            'label_block' => false,
            'default'     => esc_html__('/', 'walili'),
        ]
    );

    $this->end_controls_section();

    /**
     * Pricing Table Feature
     */
    $this->start_controls_section(
        'section_pricing_table_feature',
        [
            'label' => esc_html__('Feature', 'walili'),
        ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
        'pricing_table_item',
        [
            'label'       => esc_html__( 'List Item', 'walili' ),
            'type'        => Controls_Manager::TEXT,
            'dynamic' => ['active' => true],
            'label_block' => true,
            'default'     => esc_html__( 'Pricing table list item', 'walili' ),
        ]
    );

    $repeater->add_control(
        'pricing_table_list_icon',
        [
            'label'            => esc_html__( 'List Icon', 'walili' ),
            'type'             => Controls_Manager::ICONS,
            'default'          => [
                'value'   => 'fas fa-check',
                'library' => 'fa-solid',
            ],
        ]
    );

    $repeater->add_control(
    'pricing_table_if_item_active',
    [
        'label'        => esc_html__( 'Item Active?', 'walili' ),
        'type'         => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default'      => 'yes',
    ]
  );

    $repeater->add_control(
        'pricing_table_list_icon_color',
        [
            'label'   => esc_html__( 'Icon Color', 'walili' ),
            'type'    => Controls_Manager::COLOR,
            'default' => '#00C853',
        ]
    );

    $this->add_control(
        'pricing_table_items',
        [
            'type'        => Controls_Manager::REPEATER,
            'seperator'   => 'before',
            'default'     => [
                ['pricing_table_item' => 'Unlimited calls'],
                ['pricing_table_item' => 'Free hosting'],
                ['pricing_table_item' => '500 MB of storage space'],
                ['pricing_table_item' => '500 MB Bandwidth'],
                ['pricing_table_item' => '24/7 support'],
            ],
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{pricing_table_item}}',
        ]
    );

    $this->end_controls_section();

         /**
         * Pricing Table Footer
         */
        $this->start_controls_section(
            'section_pricing_table_footerr',
            [
                'label' => esc_html__('Button', 'walili'),
            ]
        );

        $this->add_control(
            'walili_pricing_table_button_show',
            [
                'label'        => __('Display Button', 'walili'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'walili'),
                'label_off'    => __('Hide', 'walili'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'walili_pricing_table_button_icon',
            [
                'label'            => esc_html__('Button Icon', 'walili'),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fab fa-paypal',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'walili_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_button_icon_alignment',
            [
                'label'     => esc_html__('Icon Position', 'walili'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => esc_html__('Before', 'walili'),
                    'right' => esc_html__('After', 'walili'),
                ],
                'condition' => [
                    'walili_pricing_table_button_show'      => 'yes',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_button_icon_indent',
            [
                'label'     => esc_html__('Icon Spacing', 'walili'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'condition' => [
                    'walili_pricing_table_button_show'      => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button i.fa-icon-left'  => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .walili-pricing-table-footer-button i.fa-icon-right' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .walili-pricing-table-footer-button img.fa-icon-left'  => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .walili-pricing-table-footer-button img.fa-icon-right' => 'margin-left: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_button',
            [
                'label'       => esc_html__('Button Text', 'walili'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
                'default'     => esc_html__('Buy Now', 'walili'),
                'condition'   => [
                    'walili_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_button_link',
            [
                'label'         => esc_html__('Button Link', 'walili'),
                'type'          => Controls_Manager::URL,
                'dynamic'   => ['active' => true],
                'label_block'   => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition'     => [
                    'walili_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

      /**
     * Pricing Table Ribbon
     */
    $this->start_controls_section(
        'walili_section_pricing_table_featured',
        [
            'label' => esc_html__('Ribbon', 'walili'),
        ]
    );

    $this->add_control(
        'walili_pricing_table_ribbon',
        [
            'label'        => esc_html__('Enabled?', 'walili'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'no',
        ]
    );

    $this->add_control(
    'walili_pricing_table_ribbon_styles',
    [
        'label'     => esc_html__('Style', 'walili'),
        'type'      => Controls_Manager::SELECT,
        'default'   => 'stripe',
        'options'   => [
            'stripe' => esc_html__('Stripe', 'walili'),
            'flag' => esc_html__('Flag', 'walili'),
            'circle' => esc_html__('Circle', 'walili'),
        ],
        'condition' => [
            'walili_pricing_table_ribbon' => 'yes',
        ],
    ]
   );

   $this->add_control(
    'walili_pricing_table_ribbon_text',
    [
        'label'       => esc_html__('Text', 'walili'),
        'type'        => Controls_Manager::TEXT,
        'dynamic'     => ['active' => true],
        'label_block' => false,
        'default'     => esc_html__('POPULAR', 'walili'),
        'selectors'   => [
            '{{WRAPPER}} .walili-pricing-table-content.ribbon:before' => 'content: "{{VALUE}}";',
        ],
        'condition'   => [
            'walili_pricing_table_ribbon'        => 'yes',
        ],
    ]
  );

 $this->add_control(
    'walili_pricing_table_ribbon_alignment',
    [
        'label'     => __('Alignment', 'walili'),
        'type'      => \Elementor\Controls_Manager::CHOOSE,
        'options'   => [
            'left'  => [
                'title' => __('Left', 'walili'),
                'icon'  => 'fa fa-align-left',
            ],
            'right' => [
                'title' => __('Right', 'walili'),
                'icon'  => 'fa fa-align-right',
            ],
        ],
        'default'   => 'right',
        'condition' => [
            'walili_pricing_table_ribbon'        => 'yes',
        ],
    ]
 );

  $this->end_controls_section();


    /**
   * -------------------------------------------
   * Tab Style (Pricing Table Style)
   * -------------------------------------------
   */
  $this->start_controls_section(
      'section_pricing_table_style_settings',
      [
          'label' => esc_html__('Table Style', 'walili'),
          'tab'   => Controls_Manager::TAB_STYLE,
      ]
  );

  $this->add_control(
    'pricing_table_bg_color',
    [
        'label'     => esc_html__('Background Color', 'walili'),
        'type'      => Controls_Manager::COLOR,
        'default'   => '',
        'selectors' => [
            '{{WRAPPER}} .walili-pricing-table-content' => 'background-color: {{VALUE}};',
        ],
    ]
    );

    $this->add_responsive_control(
        'pricing_table_head_padding',
        [
            'label'      => esc_html__('Head Padding', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '25',
              'right' => '0',
              'bottom' => '25',
              'left' => '0',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-hrader-background-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'pricing_table_price_padding',
        [
            'label'      => esc_html__('Price Padding', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '20',
              'right' => '30',
              'bottom' => '20',
              'left' => '30',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-price-class-padding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .walili-pricing-table-price-class' => 'padding: 0{{UNIT}} 0{{UNIT}} {{BOTTOM}}{{UNIT}} 0{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'pricing_table_future_padding',
        [
            'label'      => esc_html__('Feature Padding', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '0',
              'right' => '40',
              'bottom' => '0',
              'left' => '40',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-body-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
    'pricing_table_container_head_margin',
    [
        'label'      => esc_html__('Head Margin', 'walili'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'default'   => [
          'top' => '0',
          'right' => '0',
          'bottom' => '15',
          'left' => '0',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors'  => [
            '{{WRAPPER}} .walili-pricing-table-hrader-background-color' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
    );

    $this->add_responsive_control(
    'pricing_table_container_margin',
    [
        'label'      => esc_html__('Table Margin', 'walili'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'default'   => [
          'top' => '0',
          'right' => '0',
          'bottom' => '0',
          'left' => '0',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors'  => [
            '{{WRAPPER}} .walili-pricing-table-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'     => 'pricing_table_border',
            'label'    => esc_html__('Border Type', 'walili'),
            'fields_options' => [
                'border' => [
                  'default' => 'solid',
                ],
                'width' => [
                  'default' => [
                    'top' => '1',
                    'right' => '1',
                    'bottom' => '1',
                    'left' => '1',
                    'isLinked' => true,
                  ],
                ],
                'color' => [
                  'default' => '#808b96',
                ],
              ],
            'selector' => '{{WRAPPER}} .walili-pricing-table-content',
        ]
    );

    $this->add_responsive_control(
    'pricing_table_border_radius',
    [
        'label'      => esc_html__('Border Radius', 'walili'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'default'   => [
          'top' => '5',
          'right' => '5',
          'bottom' => '5',
          'left' => '5',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors'  => [
            '{{WRAPPER}} .walili-pricing-table-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
           'label'      => esc_html__('Shadow', 'walili'),
            'name'      => 'pricing_table_shadow',
            'selectors' => [
                '{{WRAPPER}} .walili-pricing-table-content',
            ],
        ]
    );

    $this->add_responsive_control(
    'pricing_table_head_alignment',
    [
        'label'        => esc_html__('Head Alignment', 'walili'),
        'type'         => Controls_Manager::CHOOSE,
        'label_block'  => true,
        'options'      => [
            'left'   => [
                'title' => esc_html__('Left', 'walili'),
                'icon'  => 'fa fa-align-left',
            ],
            'center' => [
                'title' => esc_html__('Center', 'walili'),
                'icon'  => 'fa fa-align-center',
            ],
            'right'  => [
                'title' => esc_html__('Right', 'walili'),
                'icon'  => 'fa fa-align-right',
            ],
        ],
        'default'      => 'center',
    ]
  );

  $this->add_responsive_control(
  'pricing_table_price_alignment',
  [
      'label'        => esc_html__('Price Alignment', 'walili'),
      'type'         => Controls_Manager::CHOOSE,
      'label_block'  => true,
      'options'      => [
          'left'   => [
              'title' => esc_html__('Left', 'walili'),
              'icon'  => 'fa fa-align-left',
          ],
          'center' => [
              'title' => esc_html__('Center', 'walili'),
              'icon'  => 'fa fa-align-center',
          ],
          'right'  => [
              'title' => esc_html__('Right', 'walili'),
              'icon'  => 'fa fa-align-right',
          ],
      ],
      'default'      => 'center',
  ]
);

    $this->add_responsive_control(
    'pricing_table_content_alignment',
    [
        'label'        => esc_html__('Content Alignment', 'walili'),
        'type'         => Controls_Manager::CHOOSE,
        'label_block'  => true,
        'options'      => [
            'left'   => [
                'title' => esc_html__('Left', 'walili'),
                'icon'  => 'fa fa-align-left',
            ],
            'center' => [
                'title' => esc_html__('Center', 'walili'),
                'icon'  => 'fa fa-align-center',
            ],
            'right'  => [
                'title' => esc_html__('Right', 'walili'),
                'icon'  => 'fa fa-align-right',
            ],
        ],
        'default'      => 'center',
    ]
  );

    $this->add_responsive_control(
    'pricing_table_content_button_alignment',
    [
        'label'        => esc_html__('Button Alignment', 'walili'),
        'type'         => Controls_Manager::CHOOSE,
        'label_block'  => true,
        'options'      => [
            'left'   => [
                'title' => esc_html__('Left', 'walili'),
                'icon'  => 'fa fa-align-left',
            ],
            'center' => [
                'title' => esc_html__('Center', 'walili'),
                'icon'  => 'fa fa-align-center',
            ],
            'right'  => [
                'title' => esc_html__('Right', 'walili'),
                'icon'  => 'fa fa-align-right',
            ],
        ],
        'default'      => 'center',
    ]
    );

    $this->end_controls_section();

    /**
   * -------------------------------------------
   * Style (Header)
   * -------------------------------------------
   */
  $this->start_controls_section(
      'section_pricing_table_header_style_settings',
      [
          'label' => esc_html__('Header', 'walili'),
          'tab'   => Controls_Manager::TAB_STYLE,
      ]
  );

  $this->add_control(
      'pricing_table_header_background_color_style',
      [
          'label' => esc_html__('Header Background', 'walili'),
          'type'  => Controls_Manager::HEADING,
      ]
  );

  $this->add_control(
      'pricing_table_header_background_color',
      [
          'label'     => esc_html__('Color', 'walili'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#1f4cd8',
          'selectors' => [
              '{{WRAPPER}} .walili-pricing-table-hrader-background-color' => '   background-color: {{VALUE}};position: relative;z-index: 0;',
          ],
      ]
  );

  $this->add_responsive_control(
  'pricing_table_header_background_border_radius',
  [
      'label'      => esc_html__('Border Radius', 'walili'),
      'type'       => Controls_Manager::DIMENSIONS,
      'size_units' => ['px', 'em', '%'],
      'default'   => [
        'top' => '5',
        'right' => '5',
        'bottom' => '0',
        'left' => '0',
        'unit' => 'px',
        'isLinked' => true,
      ],
      'selectors'  => [
          '{{WRAPPER}} .walili-pricing-table-hrader-background-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
      ],
  ]
  );

  $this->add_control(
      'pricing_table_btitle_heading_style',
      [
          'label' => esc_html__('Title Style', 'walili'),
          'type'  => Controls_Manager::HEADING,
      ]
  );

  $this->add_control(
      'pricing_table_title_color',
      [
          'label'     => esc_html__('Color', 'walili'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .walili-pricing-table-title' => 'color: {{VALUE}};',
          ],
      ]
  );

  $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'pricing_table_title_typography',
          'fields_options' => [
              'typography' => ['default' => 'yes'],
              'font_size' => ['default' => ['size' => 30]],
              'font_weight' => ['default' => 600],
              'line_height' => ['default' => ['size' => 50]],
          ],
          'selector' => '{{WRAPPER}} .walili-pricing-table-title',
      ]
  );

  $this->add_control(
      'pricing_table_subtitle_heading',
      [
          'label' => esc_html__('Subtitle Style', 'walili'),
          'type'  => Controls_Manager::HEADING,
      ]
  );

  $this->add_control(
      'pricing_subtable_title_color',
      [
          'label'     => esc_html__('Color', 'walili'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .walili-pricing-table-subtitle' => 'color: {{VALUE}};',
          ],
      ]
  );

  $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'pricing_table_subtitle_typography',
          'selector' => '{{WRAPPER}} .walili-pricing-table-subtitle',
      ]
  );
  $this->end_controls_section();

         /**
         * -------------------------------------------
         * Style (Pricing)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'section_pricing_table_title_style_settings',
            [
                'label' => esc_html__('Pricing', 'walili'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // original price
        $this->add_control(
            'pricing_table_price_tag_onsale_heading',
            [
                'label'     => esc_html__('Original Price', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_onsale_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1f4cd8',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-original-price-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_price_tag_onsale_typography',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 40]],
                ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-original-price-value',
            ]
        );

        $this->add_control(
            'pricing_table_original_price_currency_heading',
            [
                'label'     => esc_html__('Original Price Currency', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_table_original_price_currency_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1f4cd8',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-original-price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_original_price_currency_typography',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 30]],
                ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-original-price-currency',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_original_price_currency_margin',
            [
                'label'      => esc_html__('Margin', 'walili'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .walili-pricing-table-original-price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // sale price
        $this->add_control(
            'pricing_table_price_tag_heading',
            [
                'label'     => esc_html__('Sale Price', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'   => [
                    'pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_pricing_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'condition'   => [
                    'pricing_table_onsale' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-onsale-price-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_price_tag_typography',
                'fields_options' => [
                  'typography' => ['default' => 'yes'],
                  'font_size' => ['default' => ['size' => 40]],
                  ],
                  'condition'   => [
                      'pricing_table_onsale' => 'yes',
                  ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-onsale-price-value',
            ]
        );

        $this->add_control(
            'pricing_table_price_currency_heading',
            [
                'label'     => esc_html__('Sale Price Currency', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'   => [
                    'pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_pricing_curr_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'condition'   => [
                    'pricing_table_onsale' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-onsale-price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_price_cur_typography',
                'fields_options' => [
                  'typography' => ['default' => 'yes'],
                  'font_size' => ['default' => ['size' => 30]],
                  ],
                  'condition'   => [
                      'pricing_table_onsale' => 'yes',
                  ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-onsale-price-currency',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_price_cur_margin',
            [
                'label'      => esc_html__('Margin', 'walili'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition'   => [
                    'pricing_table_onsale' => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .walili-pricing-table-onsale-price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_pricing_separator_heading',
            [
                'label'     => esc_html__('Pricing Separator', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_separator_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#020101',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-price-separator' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_price_separator_typography',
                'fields_options' => [
                  'typography' => ['default' => 'yes'],
                  'font_size' => ['default' => ['size' => 20]],
                  ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-price-separator',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_period_heading',
            [
                'label'     => esc_html__('Pricing Period', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_period_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#020101',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-price-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_price_period_typography',
                'fields_options' => [
                  'typography' => ['default' => 'yes'],
                  'font_size' => ['default' => ['size' => 20]],
                  ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-price-period',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_bottom_separator',
            [
                'label'     => esc_html__('Pricing Bottom Separator', 'walili'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_table_pricing_bottom_separator_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1F4CD8',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-price-bottom-separator' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
        'pricing_table_pricing_bottom_separator_width',
        [
            'label'     => esc_html__('Width', 'walili'),
            'type'      => Controls_Manager::SLIDER,
            'default'   => [
                'size' => 70,
                'unit' => 'px',
            ],
            'range'     => [
                'px' => [
                    'max' => 1200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .walili-pricing-table-price-bottom-separator'  => 'width: {{SIZE}}px;',
            ],
        ]
        );

        $this->add_control(
        'pricing_table_pricing_bottom_separator_height',
        [
            'label'     => esc_html__('Height', 'walili'),
            'type'      => Controls_Manager::SLIDER,
            'default'   => [
                'size' => 6,
            ],
            'selectors' => [
                '{{WRAPPER}} .walili-pricing-table-price-bottom-separator'  => 'height: {{SIZE}}px;',
            ],
        ]
        );

        $this->add_responsive_control(
        'pricing_table_pricing_bottom_separator_margin',
        [
            'label'      => esc_html__('Margin', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '0',
              'right' => '0',
              'bottom' => '20',
              'left' => '0',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-price-bottom-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
        );

        $this->add_responsive_control(
        'pricing_table_pricing_bottom_separator_alignment',
        [
            'label'        => esc_html__('Alignment', 'walili'),
            'type'         => Controls_Manager::CHOOSE,
            'label_block'  => true,
            'options'      => [
                'left'   => [
                    'title' => esc_html__('Left', 'walili'),
                    'icon'  => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'walili'),
                    'icon'  => 'fa fa-align-center',
                ],
                'right'  => [
                    'title' => esc_html__('Right', 'walili'),
                    'icon'  => 'fa fa-align-right',
                ],
            ],
            'default'      => 'center',
        ]
      );


        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Style (Feature List)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'section_pricing_table_style_featured_list_settings',
            [
                'label' => esc_html__('Feature List', 'walili'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_table_list_item_color',
            [
                'label'     => esc_html__('Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
            ]
        );

        $this->add_control(
            'pricing_table_list_disable_item_color',
            [
                'label'     => esc_html__('Disable item color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
            ]
        );

    $this->add_control(
    'pricing_table_icon_enabled',
    [
        'label'        => esc_html__('List Icon', 'walili'),
        'type'         => Controls_Manager::SWITCHER,
        'return_value' => 'show',
        'default'      => 'show',
    ]
    );

        $this->add_control(
            'pricing_table_list_item_icon_size',
            [
                'label'     => esc_html__('Icon Size', 'walili'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-tab-features-li .li-icon img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .walili-pricing-tab-features-li .li-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_table_list_item_typography',
                'selector' => '{{WRAPPER}} .walili-pricing-tab-features-content',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Button Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'walili_section_pricing_table_btn_style_settings',
            [
                'label' => esc_html__('Button', 'walili'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'walili_pricing_table_btn_padding',
            [
                'label'      => esc_html__('Padding', 'walili'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'   => [
                  'top' => '10',
                  'right' => '10',
                  'bottom' => '10',
                  'left' => '10',
                  'unit' => 'px',
                  'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'walili_pricing_table_btn_margin',
            [
                'label'      => esc_html__('Margin', 'walili'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'   => [
                  'top' => '20',
                  'right' => '30',
                  'bottom' => '20',
                  'left' => '30',
                  'unit' => 'px',
                  'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_btn_icon_size',
            [
                'label'     => esc_html__('Icon Size', 'walili'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .walili-pricing-table-footer-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'walili_pricing_table_btn_typography',
                'selector' => '{{WRAPPER}} .walili-pricing-table-footer-button',
            ]
        );

        $this->add_control(
            'walili_is_button_gradient_background',
            [
                'label'        => __('Button Gradient Background', 'walili'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'walili'),
                'label_off'    => __('No', 'walili'),
                'return_value' => 'yes',
            ]
        );

        $this->start_controls_tabs('walili_cta_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('walili_pricing_table_btn_normal', ['label' => esc_html__('Normal', 'walili')]);

        $this->add_control(
            'walili_pricing_table_btn_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_btn_normal_bg_color',
            [
                'label'     => esc_html__('Background Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'walili_is_button_gradient_background' => '',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'walili_pricing_table_btn_normal_bg_gradient',
                'label'     => __('Background', 'walili'),
                'types'     => ['gradient'],
                'selector'  => '{{WRAPPER}} .walili-pricing-table-footer-button',
                'condition' => [
                    'walili_is_button_gradient_background' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'walili_pricing_table_btn_border',
                'label'    => esc_html__('Border', 'walili'),
                'fields_options' => [
                    'border' => [
                      'default' => 'solid',
                    ],
                    'width' => [
                      'default' => [
                        'top' => '1',
                        'right' => '1',
                        'bottom' => '1',
                        'left' => '1',
                        'isLinked' => true,
                      ],
                    ],
                    'color' => [
                      'default' => '#00C853',
                    ],
                  ],
                'selector' => '{{WRAPPER}} .walili-pricing-table-footer-button',
            ]
        );

        $this->add_responsive_control(
        'walili_pricing_table_btn_border_radius',
        [
            'label'      => esc_html__('Border Radius', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '5',
              'right' => '5',
              'bottom' => '5',
              'left' => '5',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-footer-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('walili_pricing_table_btn_hover', ['label' => esc_html__('Hover', 'walili')]);

        $this->add_control(
            'walili_pricing_table_btn_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_btn_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'walili_is_button_gradient_background' => '',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'walili_pricing_table_btn_hover_bg_gradient',
                'label'     => __('Background', 'walili'),
                'types'     => ['gradient'],
                'selector'  => '{{WRAPPER}} .walili-pricing-table-footer-button:hover',
                'condition' => [
                    'walili_is_button_gradient_background' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'walili_pricing_table_btn_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'walili'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .walili-pricing-table-footer-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]

        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'walili_cta_button_shadow',
                'selector'  => '{{WRAPPER}} .walili-pricing-table-footer-button',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /**
       * -------------------------------------------
       * Style (Ribbon)
       * -------------------------------------------
       */
      $this->start_controls_section(
          'walili_section_pricing_table_ribbon_style',
          [
              'label' => esc_html__('Ribbon', 'walili'),
              'tab'   => Controls_Manager::TAB_STYLE,
      'condition' => [
      'walili_pricing_table_ribbon' => 'yes',
      ],
          ]
      );

      $this->add_control(
          'walili_section_pricing_table_ribbon_text_color',
          [
              'label'     => esc_html__('Text Color', 'walili'),
              'type'      => Controls_Manager::COLOR,
              'default'   => '#fff',
              'selectors' => [
                  '{{WRAPPER}} .walili-pricing-table-content.ribbon:before' => 'color: {{VALUE}};',
              ],
      'condition' => [
                  'walili_pricing_table_ribbon'        => 'yes',
              ],
          ]
      );

      $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
      'name'     => 'walili_section_pricing_table_ribbon_text_typography',
      'fields_options' => [
        'typography' => ['default' => 'yes'],
        'font_size' => ['default' => ['size' => 14]],
        'font_weight' => ['default' => 600],
        'line_height' => ['default' => ['size' => 40]],
      ],
      'selector' => '{{WRAPPER}} .walili-pricing-table-content.ribbon:before',
       'condition' => [
                  'walili_pricing_table_ribbon'        => 'yes',
              ],
      ]
      );

      $this->add_control(
          'walili_section_pricing_table_ribbon_background_color',
          [
              'label'     => esc_html__('Background Color', 'walili'),
              'type'      => Controls_Manager::COLOR,
              'default'   => '#00C853',
              'selectors' => [
                  '{{WRAPPER}} .walili-pricing-table-content.ribbon:before' => 'background: {{VALUE}};',
              ],
              'condition' => [
                  'walili_pricing_table_ribbon'        => 'yes',
              ],
          ]
      );



      $this->add_group_control(
          \Elementor\Group_Control_Box_Shadow::get_type(),
          [
              'name'      => 'walili_section_pricing_table_ribbon_baclground_shadow',
              'label'     => __('Shadow', 'walili'),
              'selector'  => '{{WRAPPER}} .walili-pricing-table-content.ribbon:before',
              'condition' => [
                  'walili_pricing_table_ribbon'        => 'yes',
              ],
          ]
      );

      $this->add_responsive_control(
        'walili_section_pricing_table_ribbon_padding',
        [
            'label'      => esc_html__('Padding', 'walili'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'   => [
              'top' => '0',
              'right' => '0',
              'bottom' => '0',
              'left' => '0',
              'unit' => 'px',
              'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .walili-pricing-table-content.ribbon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         'condition' => [
                    'walili_pricing_table_ribbon'        => 'yes',
                ],
        ]
    );

    $this->add_responsive_control(
    'walili_section_pricing_table_ribbon_margin',
    [
        'label'      => esc_html__('Margin', 'walili'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'default'   => [
          'top' => '0',
          'right' => '0',
          'bottom' => '0',
          'left' => '0',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors'  => [
            '{{WRAPPER}} .walili-pricing-table-content.ribbon:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      'condition' => [
                    'walili_pricing_table_ribbon'        => 'yes',
                ],
    ]
    );

      $this->end_controls_section();

}


  protected function render(){
    $settings = $this->get_settings_for_display();
    if ($settings['walili_pricing_table_ribbon'] === 'yes'){
      $ribbon = "";
      if($settings['walili_pricing_table_ribbon_alignment'] === 'left'){
        if($settings['walili_pricing_table_ribbon_styles'] === 'stripe'){
          $ribbon = "ribbon ribbon_strip_left";
        }elseif($settings['walili_pricing_table_ribbon_styles'] === 'flag'){
          $ribbon = "ribbon ribbon_flag_left";
        }
        elseif($settings['walili_pricing_table_ribbon_styles'] === 'circle'){
          $ribbon = "ribbon ribbon_circle_left";
        }
      }elseif($settings['walili_pricing_table_ribbon_alignment'] === 'right'){
        if($settings['walili_pricing_table_ribbon_styles'] === 'stripe'){
          $ribbon = "ribbon ribbon_strip_right";
        }elseif($settings['walili_pricing_table_ribbon_styles'] === 'flag'){
          $ribbon = "ribbon ribbon_flag_right";
        }
        elseif($settings['walili_pricing_table_ribbon_styles'] === 'circle'){
          $ribbon = "ribbon ribbon_circle_right";
        }
      }
    }else{
      $ribbon = "";
    }
    ?>
    <div class="walili-pricing-table-content clearfix <?php echo $ribbon; ?>" style="overflow: hidden;z-index: 0;position: relative; -webkit-transition: .5s;-o-transition: .5s;transition: .5s;">
      <!--HEAD PRICE DETAIL START-->
      <div class="walili-pricing-table-head-content clearfix" style="text-align: <?php echo esc_attr($settings['pricing_table_head_alignment']); ?>" >
           <!--HEAD START-->
              <div class="walili-pricing-table-hrader-background-color">
                <div class="walili-pricing-table-title">
                    <span><?php echo esc_attr($settings['pricing_table_title']); ?></span>
                </div>
                <div class="walili-pricing-table-subtitle">
                    <span><?php echo esc_attr($settings['pricing_table_sub_title']); ?></span>
                </div>
              </div>
              <!--//HEAD END-->
          </div>
          <!--//HEAD CONTENT END-->
          <!--PRICE START-->
        <div class="walili-pricing-table-price-class-padding clearfix">
          <div class="walili-pricing-table-price-class clearfix" style="position: relative;z-index: 0;text-align: <?php echo esc_attr($settings['pricing_table_price_alignment']); ?>">
              <span class="walili-pricing-table-price-span">
                <?php if ($settings['pricing_table_onsale'] === 'yes') { ?>
                  <?php if ($settings['pricing_table_price_currency_placement'] == 'left') {?>
                    <del class="walili-pricing-table-original-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?><span class="walili-pricing-table-original-price-value"><?php echo esc_attr($settings['pricing_table_price']); ?></span></del>
                    <span class="walili-pricing-table-onsale-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?></span><span class="walili-pricing-table-onsale-price-value"><?php echo esc_attr($settings['pricing_table_onsale_price']); ?></span>
                  <?php } else if ($settings['pricing_table_price_currency_placement'] == 'right') {?>
                    <del class="walili-pricing-table-original-price-value"><?php echo esc_attr($settings['pricing_table_price']); ?><span class="walili-pricing-table-original-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?></span></del>
                    <span class="walili-pricing-table-onsale-price-value"><?php echo esc_attr($settings['pricing_table_onsale_price']); ?></span><span class="walili-pricing-table-onsale-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?></span>
                  <?php }?>
                <?php } else { ?>
                  <?php if ($settings['pricing_table_price_currency_placement'] == 'left') {?>
                    <span class="walili-pricing-table-original-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?></span><span class="walili-pricing-table-original-price-value"><?php echo esc_attr($settings['pricing_table_price']); ?></span>
                  <?php } else if ($settings['pricing_table_price_currency_placement'] == 'right') {?>
                    <span class="walili-pricing-table-original-price-value"><?php echo esc_attr($settings['pricing_table_price']); ?></span><span class="walili-pricing-table-original-price-currency"><?php echo esc_attr($settings['pricing_table_price_currency']); ?></span>
                  <?php }?>
                <?php } ?>
                <span class="walili-pricing-table-price-separator"><?php echo esc_attr($settings['pricing_table_period_separator']); ?></span>
                <span class="walili-pricing-table-price-period"><?php echo esc_attr($settings['pricing_table_price_period']); ?></span>
              </span>
          </div>
          </div>

           <?php
           if($settings['pricing_table_pricing_bottom_separator_alignment'] == 'left'){
             $price_buttom_separator_alignment = "margin-right: auto !important;";
           }elseif ($settings['pricing_table_pricing_bottom_separator_alignment'] == 'right') {
             $price_buttom_separator_alignment = "margin-left: auto !important;";
           }
           else{
             $price_buttom_separator_alignment = "margin-right: auto !important;margin-left: auto !important;";
           }
           ?>
          <div class="walili-pricing-table-price-bottom-separator" style="border-radius: 1rem;<?php echo $price_buttom_separator_alignment; ?>"></div>
          <!--//PRICE END-->


      <!--FEATURE LIST START-->
      <div class="walili-pricing-table-body-content" style="text-align: <?php echo esc_attr($settings['pricing_table_content_alignment']); ?>" >
        <?php $this->render_feature_list($settings, $this); ?>
      </div>
      <!--//FEATURE LIST END-->

      <!--BUTTON START-->
      <?php if($settings['walili_pricing_table_button_show'] == 'yes'){
        $target = $settings['walili_pricing_table_button_link']['is_external'] ? 'target="_blank"' : '';
        $nofollow = $settings['walili_pricing_table_button_link']['nofollow'] ? 'rel="nofollow"' : '';
         ?>
        <div class="walili-pricing-table-button-content clearfix" style="text-align: <?php echo esc_attr($settings['pricing_table_content_button_alignment']); ?>" >
          <a class="walili-pricing-table-footer-button" href="<?php echo esc_url($settings['walili_pricing_table_button_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> style="display: inline-block;">
              <?php if ($settings['walili_pricing_table_button_icon_alignment'] == 'left') : ?>
                <?php if (isset($settings['walili_pricing_table_button_icon']['value']['url'])) : ?>
                    <img src="<?php echo esc_attr($settings['walili_pricing_table_button_icon']['value']['url']); ?>" class="fa-icon-left" alt="<?php echo esc_attr(get_post_meta($settings['walili_pricing_table_button_icon']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
                <?php else : ?>
                    <i class="<?php echo esc_attr($settings['walili_pricing_table_button_icon']['value']); ?> fa-icon-left"></i>
                <?php endif; ?>
                  <?php echo $settings['walili_pricing_table_button']; ?>
              <?php elseif ($settings['walili_pricing_table_button_icon_alignment'] == 'right') : ?>
                  <?php echo $settings['walili_pricing_table_button']; ?>
                  <?php if (isset($settings['walili_pricing_table_button_icon']['value']['url'])) : ?>
                      <img src="<?php echo esc_attr($settings['walili_pricing_table_button_icon']['value']['url']); ?>" class="fa-icon-right" alt="<?php echo esc_attr(get_post_meta($settings['walili_pricing_table_button_icon']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
                  <?php else : ?>
                      <i class="<?php echo esc_attr($settings['walili_pricing_table_button_icon']['value']); ?> fa-icon-right"></i>
                  <?php endif; ?>
              <?php endif; ?>
          </a>
      </div>
    <?php }?>
      <!--//BUTTON END-->
  </div>
    <?php
  }

  protected function _content_template(){
    ?>
    <# if (settings.walili_pricing_table_ribbon === 'yes') {
      ribbon = "";
      if(settings.walili_pricing_table_ribbon_alignment === 'left'){
        if(settings.walili_pricing_table_ribbon_styles === 'stripe'){
          ribbon = "ribbon ribbon_strip_left";
        }else if(settings.walili_pricing_table_ribbon_styles === 'flag'){
          ribbon = "ribbon ribbon_flag_left";
        }
        else if(settings.walili_pricing_table_ribbon_styles ===  'circle'){
          ribbon = "ribbon ribbon_circle_left";
        }
      }else if(settings.walili_pricing_table_ribbon_alignment === 'right'){
        if(settings.walili_pricing_table_ribbon_styles === 'stripe'){
          ribbon = "ribbon ribbon_strip_right";
        }else if(settings.walili_pricing_table_ribbon_styles === 'flag'){
          ribbon = "ribbon ribbon_flag_right";
        }
        else if(settings.walili_pricing_table_ribbon_styles ===  'circle'){
          ribbon = "ribbon ribbon_circle_right";
        }
      }
    }else {
      ribbon = "";
    } #>
   <div class="walili-pricing-table-content clearfix {{{ribbon}}}" style="overflow: hidden;z-index: 0;position: relative; -webkit-transition: .5s;-o-transition: .5s;transition: .5s;">
    <!--HEAD PRICE DETAIL START-->
    <div class="walili-pricing-table-head-content clearfix" style="text-align: {{ settings.pricing_table_head_alignment }}">

        <!--HEAD START-->
          <div class="walili-pricing-table-hrader-background-color">
            <div class="walili-pricing-table-title">
                <span>{{{ settings.pricing_table_title}}}</span>
            </div>
            <div class="walili-pricing-table-subtitle">
                <span>{{{ settings.pricing_table_sub_title}}}</span>
            </div>
        </div>
          <!--//HEAD END-->

        <!--PRICE START-->
        <div class="walili-pricing-table-price-class-padding clearfix">
        <div class="walili-pricing-table-price-class clearfix" style="position: relative;z-index: 0;text-align: {{{ settings.pricing_table_price_alignment}}}">
            <span class="walili-pricing-table-price-span">
              <# if (settings.pricing_table_onsale === 'yes') { #>
                <# if (settings.pricing_table_price_currency_placement == 'left') { #>
                  <del class="walili-pricing-table-original-price-currency">{{{ settings.pricing_table_price_currency}}}<span class="walili-pricing-table-original-price-value">{{{ settings.pricing_table_price}}}</span></del>
                  <span class="walili-pricing-table-onsale-price-currency">{{{ settings.pricing_table_price_currency}}}</span><span class="walili-pricing-table-onsale-price-value">{{{ settings.pricing_table_onsale_price}}}</span>
                <# }else if (settings.pricing_table_price_currency_placement == 'right'){#>
                  <del class="walili-pricing-table-original-price-value">{{{ settings.pricing_table_price}}}<span class="walili-pricing-table-original-price-currency">{{{ settings.pricing_table_price_currency}}}</span></del>
                  <span class="walili-pricing-table-onsale-price-value">{{{ settings.pricing_table_onsale_price}}}</span><span class="walili-pricing-table-onsale-price-currency">{{{ settings.pricing_table_price_currency}}}</span>
                <# } #>
              <# }else {#>
                <# if (settings.pricing_table_price_currency_placement == 'left') { #>
                  <span class="walili-pricing-table-original-price-currency">{{{ settings.pricing_table_price_currency}}}</span><span class="walili-pricing-table-original-price-value">{{{ settings.pricing_table_price}}}</span>
                <# }else if (settings.pricing_table_price_currency_placement == 'right'){#>
                  <span class="walili-pricing-table-original-price-value">{{{ settings.pricing_table_price}}}</span><span class="walili-pricing-table-original-price-currency">{{{ settings.pricing_table_price_currency}}}</span>
                <# } #>
              <# } #>
                <span class="walili-pricing-table-price-separator">{{{ settings.pricing_table_period_separator}}}</span>
                <span class="walili-pricing-table-price-period">{{{ settings.pricing_table_price_period}}}</span>
            </span>
        </div>
      </div>
        <!--//PRICE END-->
        <# if (settings.pricing_table_pricing_bottom_separator_alignment == 'left') {
           price_buttom_separator_alignment = "margin-right: auto !important;";
         } else if (settings.pricing_table_pricing_bottom_separator_alignment == 'right') {
           price_buttom_separator_alignment = "margin-left: auto !important;";
         } else{
           price_buttom_separator_alignment = "margin-right: auto !important;margin-left: auto !important;";
         } #>
        <div class="walili-pricing-table-price-bottom-separator" style="border-radius: 1rem;{{{price_buttom_separator_alignment}}}"></div>


    <!--FEATURE LIST START-->
    <div class="walili-pricing-table-body-content" style="text-align: {{{ settings.pricing_table_content_alignment }}}">
      <# if(settings.pricing_table_items != null){ #>
        <ul class="walili-pricing-tab-features-ul" style="padding:0px;display: block;width: 100%;margin-bottom: 15px;list-style: none;">
          <#
          _.each( settings.pricing_table_items, function( item, index ) {
            if (item.pricing_table_if_item_active == 'yes') {
                disabled_item_style = '';
                disabled_item_color = settings.pricing_table_list_item_color;
                icon_content = item.pricing_table_list_icon.value;
                icon_color = item.pricing_table_list_icon_color;
              }
              else{
                disabled_item_style = 'text-decoration: line-through;opacity: .5;';
                disabled_item_color = settings.pricing_table_list_disable_item_color;
                icon_content = "fas fa-times";
                icon_color = disabled_item_color;
                }
          #>
          <li class="walili-pricing-tab-features-li" style="display: block;width: 100%;height: auto;padding: 10px 0px;border-bottom: 1px solid rgba(9,9,9,.04);{{{disabled_item_style}}}">
    				<# if ( settings.pricing_table_icon_enabled == 'show' ) { #>
    					<span class="li-icon" style="color:{{{ icon_color }}}">
                <# if (item.pricing_table_list_icon.value.url != null && item.pricing_table_list_icon.value.url !="") { #>
                      <img src="{{{item.pricing_table_list_icon.value.url}}}">
                  <# }else {#>
                      <i class="{{{icon_content}}}"></i>
                  <# } #>
                </span>
    				<# } #>
            <span class="walili-pricing-tab-features-content" style="color:{{{disabled_item_color}}}">{{{ item.pricing_table_item }}}</span>
    			</li>
          <#
      			} );
      		#>
        </ul>
      <# } #>
    </div>
    <!--//FEATURE LIST END-->

    <!--BUTTON START-->
    <# if(settings.walili_pricing_table_button_show == 'yes'){ #>
      <div class="walili-pricing-table-button-content clearfix" style="text-align: {{{ settings.pricing_table_content_button_alignment }}}" >
        <a class="walili-pricing-table-footer-button" href="{{{ settings.walili_pricing_table_button_link.url }}} " style="display: inline-block;">
            <# if (settings.walili_pricing_table_button_icon_alignment == 'left'){ #>
              <# if (settings.walili_pricing_table_button_icon.value.url != null && settings.walili_pricing_table_button_icon.value.url !="") {#>
                  <img src="{{{ settings.walili_pricing_table_button_icon.value.url}}}" class="fa-icon-left" />
              <# }else{ #>
                  <i class="{{{ settings.walili_pricing_table_button_icon.value}}} fa-icon-left"></i>
              <# } #>
                {{{ settings.walili_pricing_table_button}}}
            <#} else if (settings.walili_pricing_table_button_icon_alignment == 'right'){ #>
                {{{ settings.walili_pricing_table_button}}}
                <# if (settings.walili_pricing_table_button_icon.value.url != null && settings.walili_pricing_table_button_icon.value.url !=""){ #>
                    <img src="{{{ settings.walili_pricing_table_button_icon.value.url}}}" class="fa-icon-right"/>
                <#} else{#>
                    <i class="{{{ settings.walili_pricing_table_button_icon.value}}} fa-icon-right"></i>
                <# } #>
            <# } #>
        </a>
    </div>
  <# }#>
    <!--//BUTTON END-->
  </div>
    <?php
  }

  public function render_feature_list($settings, $obj)
  {
      if (empty($settings['pricing_table_items'])) {
          return;
      }
    ?>
      <ul class="walili-pricing-tab-features-ul" style="padding:0px;display: block;width: 100%;margin-bottom: 15px;list-style: none;">
          <?php
          foreach ($settings['pricing_table_items'] as $item) :
            if ($item['pricing_table_if_item_active'] == 'yes') {
                $disabled_item_style = '';
                $disabled_item_color = $settings['pricing_table_list_item_color'];
                $icon_content = $item['pricing_table_list_icon']['value'];
                $icon_color = $item['pricing_table_list_icon_color'];
              }
              else{
                $disabled_item_style = 'text-decoration: line-through;opacity: .5;';
                $disabled_item_color = $settings['pricing_table_list_disable_item_color'];
                $icon_content = "fas fa-times";
                $icon_color = $disabled_item_color;
                }
          ?>
              <li class="walili-pricing-tab-features-li" style="display: block;width: 100%;height: auto;padding: 10px 0px;border-bottom: 1px solid rgba(9,9,9,.04);<?php echo $disabled_item_style; ?>">
                  <?php if ('show' === $settings['pricing_table_icon_enabled']) : ?>
                      <span class="li-icon" style="color:<?php echo $icon_color; ?>">
                          <?php if (isset($item['pricing_table_list_icon']['value']['url'])) : ?>
                              <img src="<?php echo $item['pricing_table_list_icon']['value']['url']; ?>" />
                          <?php else : ?>
                              <i class="<?php echo $icon_content; ?>"></i>
                          <?php endif; ?>
                      </span>
                  <?php endif; ?>
                  <span class="walili-pricing-tab-features-content" style="color:<?php echo $disabled_item_color; ?>"><?php echo $item['pricing_table_item']; ?></span>
              </li>
          <?php
          endforeach;
          ?>
      </ul>
  <?php
  }

}

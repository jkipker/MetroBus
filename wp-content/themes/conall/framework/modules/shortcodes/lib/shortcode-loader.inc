<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\Lib;

use ConallEdgeNamespace\Modules\Shortcodes\Accordion\Accordion;
use ConallEdgeNamespace\Modules\Shortcodes\AccordionTab\AccordionTab;
use ConallEdgeNamespace\Modules\Shortcodes\AnimationHolder\AnimationHolder;
use ConallEdgeNamespace\Modules\Shortcodes\BlogList\BlogList;
use ConallEdgeNamespace\Modules\Shortcodes\BlogSlider\BlogSlider;
use ConallEdgeNamespace\Modules\Shortcodes\Button\Button;
use ConallEdgeNamespace\Modules\Shortcodes\CallToAction\CallToAction;
use ConallEdgeNamespace\Modules\Shortcodes\CallToActionSlider\CallToActionSlider;
use ConallEdgeNamespace\Modules\Shortcodes\Counter\Countdown;
use ConallEdgeNamespace\Modules\Shortcodes\Counter\Counter;
use ConallEdgeNamespace\Modules\Shortcodes\CustomFont\CustomFont;
use ConallEdgeNamespace\Modules\Shortcodes\Dropcaps\Dropcaps;
use ConallEdgeNamespace\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use ConallEdgeNamespace\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocks\GalleryBlocks;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksLeftItem\GalleryBlocksLeftItem;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksRightItem\GalleryBlocksRightItem;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksMasonry\GalleryBlocksMasonry;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksMasonryItem\GalleryBlocksMasonryItem;
use ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksTwo\GalleryBlocksTwo;
use ConallEdgeNamespace\Modules\Shortcodes\GoogleMap\GoogleMap;
use ConallEdgeNamespace\Modules\Shortcodes\Highlight\Highlight;
use ConallEdgeNamespace\Modules\Shortcodes\Icon\Icon;
use ConallEdgeNamespace\Modules\Shortcodes\IconListItem\IconListItem;
use ConallEdgeNamespace\Modules\Shortcodes\IconWithText\IconWithText;
use ConallEdgeNamespace\Modules\Shortcodes\ImageGallery\ImageGallery;
use ConallEdgeNamespace\Modules\Shortcodes\ImageWithText\ImageWithText;
use ConallEdgeNamespace\Modules\Shortcodes\Message\Message;
use ConallEdgeNamespace\Modules\Shortcodes\NumberWithText\NumberWithText;
use ConallEdgeNamespace\Modules\Shortcodes\OrderedList\OrderedList;
use ConallEdgeNamespace\Modules\Shortcodes\ParallaxSections\ParallaxSections;
use ConallEdgeNamespace\Modules\Shortcodes\ParallaxSection\ParallaxSection;
use ConallEdgeNamespace\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use ConallEdgeNamespace\Modules\Shortcodes\PricingTables\PricingTables;
use ConallEdgeNamespace\Modules\Shortcodes\PricingTable\PricingTable;
use ConallEdgeNamespace\Modules\Shortcodes\ProgressBar\ProgressBar;
use ConallEdgeNamespace\Modules\Shortcodes\ProductList\ProductList;
use ConallEdgeNamespace\Modules\Shortcodes\SectionTitle\SectionTitle;
use ConallEdgeNamespace\Modules\Shortcodes\Separator\Separator;
use ConallEdgeNamespace\Modules\Shortcodes\SocialShare\SocialShare;
use ConallEdgeNamespace\Modules\Shortcodes\Tabs\Tabs;
use ConallEdgeNamespace\Modules\Shortcodes\Tab\Tab;
use ConallEdgeNamespace\Modules\Shortcodes\Team\Team;
use ConallEdgeNamespace\Modules\Shortcodes\TeamCarousels\TeamCarousels;
use ConallEdgeNamespace\Modules\Shortcodes\TeamCarousel\TeamCarousel;
use ConallEdgeNamespace\Modules\Shortcodes\UnorderedList\UnorderedList;
use ConallEdgeNamespace\Modules\Shortcodes\Video\Video;


/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
        $this->addShortcode(new AnimationHolder());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new Button());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new CallToActionSlider());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new GalleryBlocks());
		$this->addShortcode(new GalleryBlocksLeftItem());
		$this->addShortcode(new GalleryBlocksRightItem());
		$this->addShortcode(new GalleryBlocksMasonry());
		$this->addShortcode(new GalleryBlocksMasonryItem());
		$this->addShortcode(new GalleryBlocksTwo());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new ImageWithText());
		$this->addShortcode(new Message());
		$this->addShortcode(new NumberWithText());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new ParallaxSections());
		$this->addShortcode(new ParallaxSection());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		if(conall_edge_is_woocommerce_installed()){
			$this->addShortcode(new ProductList());
		}
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new Team());
		$this->addShortcode(new TeamCarousels());
		$this->addShortcode(new TeamCarousel());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Video());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();
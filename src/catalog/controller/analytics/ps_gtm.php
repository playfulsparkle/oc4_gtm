<?php
namespace Opencart\Catalog\Controller\Extension\PsGtm\Analytics;
/**
 * Class PsGtm
 *
 * @package Opencart\Catalog\Controller\Extension\PsGtm\Analytics
 */
class PsGtm extends \Opencart\System\Engine\Controller
{
    const GTM_GRANTED = 'granted';

    const GTM_DENIED = 'denied';

    /**
     * Render Google Tag Manager script with consent configuration
     *
     * @return string HTML script tag for GTM or empty string if disabled
     */
    public function index(): string
    {
        // Check if GTM integration is enabled
        if (!$this->config->get('analytics_ps_gtm_status')) {
            return '';
        }

        /**
         * Google Tag Manager container ID (e.g., 'GTM-XXXXXX')
         * This is the unique identifier for your GTM container
         */
        $gtm_id = $this->config->get('analytics_ps_gtm_gtm_id');

        /**
         * Enable Google Consent Mode integration
         * When enabled, consent preferences are sent to Google services
         */
        $gcm_status = (bool) $this->config->get('analytics_ps_gtm_gcm_status');

        /**
         * Consent for ad-related storage (cookies)
         * Controls storage (like cookies) for advertising purposes
         * 'granted' = allowed, 'denied' = blocked
         */
        $ad_storage = (bool) $this->config->get('analytics_ps_gtm_ad_storage');

        /**
         * Consent for sharing data with Google for advertising purposes
         * Controls whether user data can be sent to Google for advertising
         * 'granted' = allowed, 'denied' = blocked
         */
        $ad_user_data = (bool) $this->config->get('analytics_ps_gtm_ad_user_data');

        /**
         * Consent for ad personalization
         * Controls whether personalized advertising is allowed
         * 'granted' = allowed, 'denied' = blocked
         */
        $ad_personalization = (bool) $this->config->get('analytics_ps_gtm_ad_personalization');

        /**
         * Consent for analytics storage
         * Controls storage (like cookies) for analytics purposes
         * 'granted' = allowed, 'denied' = blocked
         */
        $analytics_storage = (bool) $this->config->get('analytics_ps_gtm_analytics_storage');

        /**
         * Consent for functionality storage
         * Controls storage that enables website functionality
         * 'granted' = allowed, 'denied' = blocked
         */
        $functionality_storage = (bool) $this->config->get('analytics_ps_gtm_functionality_storage');

        /**
         * Consent for personalization storage
         * Controls storage for personalization features
         * 'granted' = allowed, 'denied' = blocked
         */
        $personalization_storage = (bool) $this->config->get('analytics_ps_gtm_personalization_storage');

        /**
         * Consent for security storage
         * Controls storage for security purposes (fraud prevention, authentication)
         * 'granted' = allowed, 'denied' = blocked
         */
        $security_storage = (bool) $this->config->get('analytics_ps_gtm_security_storage');

        /**
         * Wait time (in milliseconds) before updating consent
         * Allows time for consent providers to update before tags fire
         */
        $wait_for_update = (int) $this->config->get('analytics_ps_gtm_wait_for_update');

        /**
         * Enable ads data redaction
         * When true, Google ads tags will redact ad click identifiers from URLs
         * Helps with user privacy by removing sensitive URL parameters
         */
        $ads_data_redaction = (bool) $this->config->get('analytics_ps_gtm_ads_data_redaction');

        /**
         * Enable URL passthrough
         * When true, retains original URL parameters for measurement purposes
         * Useful for tracking campaigns while maintaining user privacy
         */
        $url_passthrough = (bool) $this->config->get('analytics_ps_gtm_url_passthrough');

        $html = "<script>" . PHP_EOL;
        $html .= "window.dataLayer = window.dataLayer || [];" . PHP_EOL;
        $html .= "function gtag() { dataLayer.push(arguments); }" . PHP_EOL;

        if ($gcm_status) {
            $default_consent = [
                'ad_storage' => $ad_storage ? self::GTM_GRANTED : self::GTM_DENIED,
                'ad_user_data' => $ad_user_data ? self::GTM_GRANTED : self::GTM_DENIED,
                'ad_personalization' => $ad_personalization ? self::GTM_GRANTED : self::GTM_DENIED,
                'analytics_storage' => $analytics_storage ? self::GTM_GRANTED : self::GTM_DENIED,
                'functionality_storage' => $functionality_storage ? self::GTM_GRANTED : self::GTM_DENIED,
                'personalization_storage' => $personalization_storage ? self::GTM_GRANTED : self::GTM_DENIED,
                'security_storage' => $security_storage ? self::GTM_GRANTED : self::GTM_DENIED,
            ];

            if ($wait_for_update > 0) {
                $default_consent['wait_for_update'] = $wait_for_update;
            }

            $default_consent_json = json_encode($default_consent);

            $ads_data_redaction_str = $ads_data_redaction ? 'true' : 'false';
            $url_passthrough_str = $url_passthrough ? 'true' : 'false';

            $html .= PHP_EOL . "gtag('consent', 'default', " . $default_consent_json . ");" . PHP_EOL;
            $html .= "gtag('set', 'ads_data_redaction', " . $ads_data_redaction_str . ");" . PHP_EOL;
            $html .= "gtag('set', 'url_passthrough', " . $url_passthrough_str . ");" . PHP_EOL;
        }

        $html .= "</script>" . PHP_EOL;
        $html .= "<!-- Google Tag Manager -->" . PHP_EOL;
        $html .= "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':" . PHP_EOL;
        $html .= "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0]," . PHP_EOL;
        $html .= "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=" . PHP_EOL;
        $html .= "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);" . PHP_EOL;
        $html .= "})(window,document,'script','dataLayer','" . $gtm_id . "');</script>" . PHP_EOL;
        $html .= "<!-- End Google Tag Manager -->" . PHP_EOL;

        return $html;
    }

    /**
     * Event handler for `catalog/view/common/header/before`.
     *
     * @param string $route
     * @param array $args
     * @param string $template
     *
     * @return void
     */
    public function eventCatalogViewCommonHeaderBefore(string &$route, array &$args, string &$template): void
    {
        if (!$this->config->get('analytics_ps_gtm_status')) {
            return;
        }

        $this->load->model('extension/ps_gtm/analytics/ps_gtm');

        $args['ps_gtm_gtm_id'] = $this->config->get('analytics_ps_gtm_gtm_id');

        $headerViews = $this->model_extension_ps_gtm_analytics_ps_gtm->replaceHeaderViews($args);

        $template = $this->replaceViews($route, $template, $headerViews);
    }

    /**
     * Retrieves the contents of a template file based on the provided route.
     *
     * This method checks if an event template buffer is provided. If so, it returns that buffer.
     * If not, it constructs the template file path based on the current theme settings and checks
     * for the existence of the template file. If the file exists, it reads and returns its contents.
     * It supports loading templates from both the specified theme directory and the default template directory.
     *
     * @param string $route The route for which the template is being retrieved.
     *                      This should match the naming convention for the template files.
     * @param string $event_template_buffer The template buffer that may be passed from an event.
     *                                       If provided, this buffer will be returned directly,
     *                                       bypassing file retrieval.
     *
     * @return mixed Returns the contents of the template file as a string if it exists,
     *               or false if the template file cannot be found or read.
     */
    protected function getTemplateBuffer(string $route, string $event_template_buffer): mixed
    {
        if ($event_template_buffer) {
            return $event_template_buffer;
        }

        if (defined('DIR_CATALOG')) {
            $dir_template = DIR_TEMPLATE;
        } else {
            if ($this->config->get('config_theme') == 'default') {
                $theme = $this->config->get('theme_default_directory');
            } else {
                $theme = $this->config->get('config_theme');
            }

            $dir_template = DIR_TEMPLATE . $theme . '/template/';
        }

        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        if (defined('DIR_CATALOG')) {
            return false;
        }

        $dir_template = DIR_TEMPLATE . 'default/template/';
        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        // Support for OC4 catalog
        $dir_template = DIR_TEMPLATE;
        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        return false;
    }

    /**
     * Checks and modifies the provided file path based on predefined directory constants.
     *
     * This method checks if the file path starts with specific directory constants (`DIR_MODIFICATION`,
     * `DIR_APPLICATION`, and `DIR_SYSTEM`). Depending on these conditions, it modifies the file path to
     * point to the appropriate directory under `DIR_MODIFICATION`.
     *
     * - If the file path starts with `DIR_MODIFICATION`, it checks if it should point to either the
     *   `admin` or `catalog` directory based on the definition of `DIR_CATALOG`.
     * - If `DIR_CATALOG` is defined, the method checks for the file in the `admin` directory.
     *   Otherwise, it checks in the `catalog` directory.
     * - If the file path starts with `DIR_SYSTEM`, it checks for the file in the `system` directory
     *   within `DIR_MODIFICATION`.
     *
     * The method ensures that the returned file path exists before modifying it.
     *
     * @param string $file The original file path to check and modify.
     * @return string|null The modified file path if found, or null if it does not exist.
     */
    protected function modCheck(string $file): mixed
    {
        if (defined('DIR_MODIFICATION')) {
            if ($this->startsWith($file, DIR_MODIFICATION)) {
                if (defined('DIR_CATALOG')) {
                    if (file_exists(DIR_MODIFICATION . 'admin/' . substr($file, strlen(DIR_APPLICATION)))) {
                        $file = DIR_MODIFICATION . 'admin/' . substr($file, strlen(DIR_APPLICATION));
                    }
                } else {
                    if (file_exists(DIR_MODIFICATION . 'catalog/' . substr($file, strlen(DIR_APPLICATION)))) {
                        $file = DIR_MODIFICATION . 'catalog/' . substr($file, strlen(DIR_APPLICATION));
                    }
                }
            } elseif ($this->startsWith($file, DIR_SYSTEM)) {
                if (file_exists(DIR_MODIFICATION . 'system/' . substr($file, strlen(DIR_SYSTEM)))) {
                    $file = DIR_MODIFICATION . 'system/' . substr($file, strlen(DIR_SYSTEM));
                }
            }
        }

        return $file;
    }

    /**
     * Checks if a given string starts with a specified substring.
     *
     * This method determines if the string $haystack begins with the substring $needle.
     *
     * @param string $haystack The string to be checked.
     * @param string $needle The substring to search for at the beginning of $haystack.
     *
     * @return bool Returns true if $haystack starts with $needle; otherwise, false.
     */
    protected function startsWith(string $haystack, string $needle): bool
    {
        if (strlen($haystack) < strlen($needle)) {
            return false;
        }

        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    /**
     * Replaces specific occurrences of a substring in a string with a new substring.
     *
     * This method searches for all occurrences of a specified substring ($search) in a given string ($string)
     * and replaces the occurrences at the positions specified in the $nthPositions array with a new substring ($replace).
     *
     * @param string $search The substring to search for in the string.
     * @param string $replace The substring to replace the found occurrences with.
     * @param string $string The input string in which replacements will be made.
     * @param array $nthPositions An array of positions (1-based index) indicating which occurrences
     *                            of the search substring to replace.
     *
     * @return mixed The modified string with the specified occurrences replaced, or the original string if no matches are found.
     */
    protected function replaceNth(string $search, string $replace, string $string, array $nthPositions): mixed
    {
        $pattern = '/' . preg_quote($search, '/') . '/';
        $matches = [];
        $count = preg_match_all($pattern, $string, $matches, PREG_OFFSET_CAPTURE);

        if ($count > 0) {
            foreach ($nthPositions as $nth) {
                if ($nth > 0 && $nth <= $count) {
                    $offset = $matches[0][$nth - 1][1];
                    $string = substr_replace($string, $replace, $offset, strlen($search));
                }
            }
        }

        return $string;
    }

    /**
     * Replaces placeholders in a template with corresponding values from the views array.
     *
     * This method retrieves the template content based on the given route and template name,
     * then replaces specified search strings with their corresponding replace strings.
     * If positions are specified, the method performs replacements only at those positions.
     *
     * @param string $route The route associated with the template.
     * @param string $template The name of the template to be processed.
     * @param array $views An array of associative arrays where each associative array contains:
     *                     - string 'search': The string to search for in the template.
     *                     - string 'replace': The string to replace the 'search' string with.
     *                     - array|null 'positions': (Optional) An array of positions
     *                     where replacements should occur. If not provided,
     *                     all occurrences will be replaced.
     *
     * @return mixed The modified template content after performing the replacements.
     */
    protected function replaceViews(string $route, string $template, array $views): mixed
    {
        $output = $this->getTemplateBuffer($route, $template);

        foreach ($views as $view) {
            if (isset($view['positions']) && $view['positions']) {
                $output = $this->replaceNth($view['search'], $view['replace'], $output, $view['positions']);
            } else {
                $output = str_replace($view['search'], $view['replace'], $output);
            }
        }

        return $output;
    }
}

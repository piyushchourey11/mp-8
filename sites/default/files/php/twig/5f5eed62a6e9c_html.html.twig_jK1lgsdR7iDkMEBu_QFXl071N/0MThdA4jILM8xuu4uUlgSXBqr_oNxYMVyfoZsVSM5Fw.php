<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/mobile_pundits/templates/html.html.twig */
class __TwigTemplate_d761a732b2c14b0ab943fd6d7f2f25a9c4d976b7741fe82079c96ce3a7813ec7 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "if" => 166];
        $filters = ["clean_class" => 5, "escape" => 16, "safe_join" => 22, "t" => 61];
        $functions = ["active_theme_path" => 20];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape', 'safe_join', 't'],
                ['active_theme_path']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 2
        $context["body_classes"] = [0 => "body-space", 1 => (( !        // line 4
($context["logged_in"] ?? null)) ? ("not-logged-in") : ("")), 2 => (( !        // line 5
($context["root_path"] ?? null)) ? ("path-frontpage") : (("path-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["root_path"] ?? null)))))), 3 => (($this->getAttribute(        // line 6
($context["path_info"] ?? null), "args", [])) ? (("path-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["path_info"] ?? null), "args", [])))) : ("")), 4 => ((        // line 7
($context["node_type"] ?? null)) ? (("page-node-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["node_type"] ?? null))))) : ("")), 5 => ((        // line 8
($context["db_offline"] ?? null)) ? ("db-offline") : ("")), 6 => (($this->getAttribute($this->getAttribute(        // line 9
($context["theme"] ?? null), "settings", []), "navbar_position", [])) ? (("navbar-is-" . $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", []), "navbar_position", [])))) : ("")), 7 => (($this->getAttribute(        // line 10
($context["theme"] ?? null), "has_glyphicons", [])) ? ("has-glyphicons") : ("")), 8 => ((        // line 11
($context["current_path"] ?? null)) ? (("context" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["current_path"] ?? null))))) : (""))];
        // line 14
        echo "
<!DOCTYPE html>
<html";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["html_attributes"] ?? null)), "html", null, true);
        echo ">
  <head>

    <head-placeholder token=\"";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
    <link href=\"";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/favicon.ico\" rel=\"apple-touch-icon\" />
    <link rel=\"shortcut icon\" href=\"";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/favicon.ico\" type=\"image/vnd.microsoft.icon\"/>
    <title>";
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["head_title"] ?? null)), " | "));
        echo "</title>
    <css-placeholder token=\"";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
    <js-placeholder token=\"";
        // line 24
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
    
 <script type=\"text/javascript\">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
\t  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
\t  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
\t  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
\t
\t  ga('create', 'UA-6615735-3', 'mobilepundits.com');
\t  ga('send', 'pageview');
   

</script>
<script type=\"text/javascript\">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/55b1f33a65c887f36f65f2b2/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();

</script>
";
        // line 50
        echo "<script>
\tvar base_path='";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "';
</script>
  </head>
  <body ";
        // line 54
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["body_classes"] ?? null)], "method")), "html", null, true);
        echo ">
   <div id=\"back_bg_popup\">
            <div class=\"loader_image_popup\">
                <img src=\"";
        // line 57
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/req/bx_loader.gif\" class=\"loader_gif\">
            </div>
        </div>
        <div id=\"skip-link\">
            <a href=\"#main-content\" class=\"element-invisible element-focusable\">";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Skip to main content"));
        echo "</a>
        </div>
        ";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_top"] ?? null)), "html", null, true);
        echo "
        ";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page"] ?? null)), "html", null, true);
        echo "
        ";
        // line 65
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_bottom"] ?? null)), "html", null, true);
        echo "
        
        <!-- Light box form-->
        <div class=\"light-form\" id=\"light_pop_form\">
            <a class=\"lig_close \" href='javascript:void(0)' onclick=\"\$(this).closest('#light_pop_form').hide()\" >&times;</a>
            <h4 class=\"light-info\"> Please fill the form below to download the Insight.</h4>
            <span id=\"insight-talkmsg\" class=\"deliverymsg \" style=\"display: none\">
                <i class=\"fa fa-check-circle\"></i>
                Insights Download link sent to your email, please check your mail for more info 
            </span>
           webform-client-form-55
        </div>  
        <!-- Light box form-->

      <!--Contact us page form   Start-->
        <div id=\"contact_page_form\" class=\"modal fade\" role=\"dialog\">
            <div class=\"modal-dialog\">
                <!-- Modal content-->
                <div class=\"modal-content clearfix\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                        <h4 class=\"modal-title head-cont\"><i class=\"fa  fa-envelope-o mob-icon-con\" ></i> Contact Us</h4>
                    </div>
                    <div class=\"modal-body\">
                        <div>
                            <div class=\"mob-scroll\">
                                <div class=\"form-main pull-left col-md-8 col-sm-8 col-xs-12 nopadding\"> 
                                    <span id=\"contact_page_talkmsg\" class=\"success_msg_class\" style=\"display: none\"> Thanks for contacting us, someone from our team will be in touch with you soon.</span>
                                    webform-client-form-292
                                    
                                   
                                    
                                </div>
                                <div class=\"pull-right  col-md-4 col-sm-4 col-xs-12 right-form\">
                                    <div class=\"call_us\">
                                        <h3 class=\"popup_head_2\"><span></span>Call Us</h3>
                                        <ul class=\"contact_no\">
                                          
                                            <li class=\"c_flag_uk\">  USA : +1-732-734-4774</li>
                                            <li class=\"c_flag_aus\"> AUS : +61-2-8015-5723</li>
                                            <li class=\"c_flag_ireland\" style=\"font-size:13px\"> FRANCE : +33-7-68-79-77-46</li>
                                            <li class=\"c_flag_india\"> INDIA : +91-731-402-5351</li>
                                        </ul>
                                    </div>
                                    <div class=\"email_us\">
                                        <h3 class=\"popup_head_2 email-ic\"><span class=\"\"></span>Email Us</h3>
                                        <ul class=\"mail_info\">
                                            <li>
                                                <label>Sales :</label>
                                                <a href=\"mailto:sales@mobilepundits.com?Subject=Hello%20again\" target=\"_top\">sales@mobilepundits.com</a></li>
                                            <li>
                                                <label>Marketing :</label>
                                                <a href=\"mailto:marketing@mobilepundits.com?Subject=Hello%20again\" target=\"_top\">marketing@mobilepundits.com</a></li>
                                            <li>
                                                <label>General Information :</label>
                                                <a href=\"mailto:info@mobilepundits.com?Subject=Hello%20again\" target=\"_top\">info@mobilepundits.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Contact us page form   END-->  

        <!--Contact form popup Start-->
        <div class=\"modal fade\" id=\"dwn_alert\" role=\"dialog\">
            <div class=\"model_dialog_popup\">
                <div class=\"modal-dialog \"> 
                    <!-- Modal content-->
                    <div class=\"modal-content\">
                        <div id=\"close_button_div\">
                            <button id=\"modal_dismiss_btn\" type=\"button\" class=\"close-btn btn btn-default btn-danger\" data-dismiss=\"modal\">Close</button>
                        </div>
                        <h1>Please fill the form</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--Contact form popup End-->

                <!--Contact form popup Start-->
        <div class=\"modal fade\" id=\"slider_popup\" role=\"dialog\">
            <div class=\"model_dialog_popup\">
                <div class=\"modal-dialog \"> 
                    <!-- Modal content-->
                    <div class=\"modal-content\">
                        <div id=\"close_button_div\">
                            <button id=\"modal_dismiss_btn\" type=\"button\" class=\"close-btn btn btn-default btn-danger\" data-dismiss=\"modal\">Close</button>
                        </div>
                        <h1>Please fill the form</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--Contact form popup End-->


     
";
        // line 166
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 167
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo " 
 ";
        }
        // line 169
        echo "<js-bottom-placeholder token=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "themes/mobile_pundits/templates/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 169,  267 => 167,  265 => 166,  161 => 65,  157 => 64,  153 => 63,  148 => 61,  140 => 57,  134 => 54,  128 => 51,  125 => 50,  97 => 24,  93 => 23,  89 => 22,  84 => 21,  79 => 20,  75 => 19,  69 => 16,  65 => 14,  63 => 11,  62 => 10,  61 => 9,  60 => 8,  59 => 7,  58 => 6,  57 => 5,  56 => 4,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mobile_pundits/templates/html.html.twig", "D:\\server\\Apache24\\htdocs\\drupal-895\\themes\\mobile_pundits\\templates\\html.html.twig");
    }
}

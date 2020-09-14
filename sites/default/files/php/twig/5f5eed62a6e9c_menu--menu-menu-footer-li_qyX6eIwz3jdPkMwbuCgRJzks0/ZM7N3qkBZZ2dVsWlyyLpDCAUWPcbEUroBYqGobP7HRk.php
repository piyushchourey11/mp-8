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

/* themes/mobile_pundits/templates/menu--menu-menu-footer-links.html.twig */
class __TwigTemplate_e12fe25386be8ee2b4570390cd157fed5fd5b4750f67237788802e9d28d1b97f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 4, "macro" => 11, "if" => 13, "for" => 17, "set" => 20];
        $filters = ["escape" => 32, "date" => 32, "raw" => 22];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'date', 'raw'],
                []
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
        echo "<div id=\"footer\" class=\"footer \">

";
        // line 4
        $context["menus"] = $this;
        // line 5
        echo "      ";
        // line 9
        echo "      ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0));
        echo "

  ";
        // line 31
        echo "  <div class=\"col-md-12 text-center\">
    <p>Copyright © ";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " Mobile Pundits. All Rights Reserved. </p>
  </div>
  </div>";
    }

    // line 11
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 12
            echo "        ";
            $context["menus"] = $this;
            // line 13
            echo "        ";
            if (($context["items"] ?? null)) {
                // line 14
                echo "          ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 15
                    echo "            <ul class=\"footer-link\">
          ";
                }
                // line 17
                echo "     ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 18
                    echo "           ";
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 19
                        echo "           ";
                    } else {
                        // line 20
                        echo "           ";
                        $context["menutitle"] = $this->getAttribute($context["item"], "title", []);
                        // line 21
                        echo "           ";
                        $context["newTitle"] = ($context["menutitle"] ?? null);
                        // line 22
                        echo "\t\t\t     ";
                        ob_start(function () { return ''; });
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed(($context["newTitle"] ?? null)));
                        $context["link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                        // line 23
                        echo "              <li title=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_text"] ?? null)), "html", null, true);
                        echo "\" id=\"TAB_";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_text"] ?? null)), "html", null, true);
                        echo "\" ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "attributes", [])), "html", null, true);
                        echo "> 
              <a href=\"";
                        // line 24
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" target=\"_blank\">";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_text"] ?? null)), "html", null, true);
                        echo "</a>
              </li>
\t\t\t\t ";
                    }
                    // line 27
                    echo "     ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 28
                echo "       </ul>
      ";
            }
            // line 30
            echo "  ";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "themes/mobile_pundits/templates/menu--menu-menu-footer-links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  155 => 30,  151 => 28,  145 => 27,  137 => 24,  128 => 23,  123 => 22,  120 => 21,  117 => 20,  114 => 19,  111 => 18,  106 => 17,  102 => 15,  99 => 14,  96 => 13,  93 => 12,  79 => 11,  72 => 32,  69 => 31,  63 => 9,  61 => 5,  59 => 4,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mobile_pundits/templates/menu--menu-menu-footer-links.html.twig", "D:\\server\\Apache24\\htdocs\\drupal-895\\themes\\mobile_pundits\\templates\\menu--menu-menu-footer-links.html.twig");
    }
}

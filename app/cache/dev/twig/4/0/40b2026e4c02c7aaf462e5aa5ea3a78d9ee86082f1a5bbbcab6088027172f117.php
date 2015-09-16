<?php

/* base.html.twig */
class __TwigTemplate_40b2026e4c02c7aaf462e5aa5ea3a78d9ee86082f1a5bbbcab6088027172f117 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_997106c34c1694b0f2b2bbbeacbbffbba0d40da15aa663ed25fef27ed019a52c = $this->env->getExtension("native_profiler");
        $__internal_997106c34c1694b0f2b2bbbeacbbffbba0d40da15aa663ed25fef27ed019a52c->enter($__internal_997106c34c1694b0f2b2bbbeacbbffbba0d40da15aa663ed25fef27ed019a52c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <!-- Latest compiled and minified CSS -->
        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css\">

        <!-- Optional theme -->
        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css\">

        <!-- Latest compiled and minified JavaScript -->
        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js\"></script>
    </head>
    <body>
        <nav class=\"navbar navbar-inverse navbar-fixed-top\">
            <div class=\"container\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\">EduSpeak</a>
                </div>
                <div id=\"navbar\" class=\"navbar-collapse collapse\">
                    <form class=\"navbar-form navbar-right\">
                        <button type=\"submit\" class=\"btn btn-success\">Sign in</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        ";
        // line 36
        $this->displayBlock('body', $context, $blocks);
        // line 37
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 38
        echo "        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
    </body>
</html>
";
        
        $__internal_997106c34c1694b0f2b2bbbeacbbffbba0d40da15aa663ed25fef27ed019a52c->leave($__internal_997106c34c1694b0f2b2bbbeacbbffbba0d40da15aa663ed25fef27ed019a52c_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_9964363443ea7aa41aa8a46957686f2a6057cada773519133528c620e0ae64ea = $this->env->getExtension("native_profiler");
        $__internal_9964363443ea7aa41aa8a46957686f2a6057cada773519133528c620e0ae64ea->enter($__internal_9964363443ea7aa41aa8a46957686f2a6057cada773519133528c620e0ae64ea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_9964363443ea7aa41aa8a46957686f2a6057cada773519133528c620e0ae64ea->leave($__internal_9964363443ea7aa41aa8a46957686f2a6057cada773519133528c620e0ae64ea_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_1b26a93016944f9fc578fe03f2855682b3f2b7f7b312bc7a470ffd0cbb0ad329 = $this->env->getExtension("native_profiler");
        $__internal_1b26a93016944f9fc578fe03f2855682b3f2b7f7b312bc7a470ffd0cbb0ad329->enter($__internal_1b26a93016944f9fc578fe03f2855682b3f2b7f7b312bc7a470ffd0cbb0ad329_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_1b26a93016944f9fc578fe03f2855682b3f2b7f7b312bc7a470ffd0cbb0ad329->leave($__internal_1b26a93016944f9fc578fe03f2855682b3f2b7f7b312bc7a470ffd0cbb0ad329_prof);

    }

    // line 36
    public function block_body($context, array $blocks = array())
    {
        $__internal_b892ed1a6896e972c7be3488acabc982e301f722e2d66e21b9d97f13266b602f = $this->env->getExtension("native_profiler");
        $__internal_b892ed1a6896e972c7be3488acabc982e301f722e2d66e21b9d97f13266b602f->enter($__internal_b892ed1a6896e972c7be3488acabc982e301f722e2d66e21b9d97f13266b602f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_b892ed1a6896e972c7be3488acabc982e301f722e2d66e21b9d97f13266b602f->leave($__internal_b892ed1a6896e972c7be3488acabc982e301f722e2d66e21b9d97f13266b602f_prof);

    }

    // line 37
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_ccbf8b4d583b70b0fbee5f89de8712edc778d3c37c563c370dd5438908f551a1 = $this->env->getExtension("native_profiler");
        $__internal_ccbf8b4d583b70b0fbee5f89de8712edc778d3c37c563c370dd5438908f551a1->enter($__internal_ccbf8b4d583b70b0fbee5f89de8712edc778d3c37c563c370dd5438908f551a1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_ccbf8b4d583b70b0fbee5f89de8712edc778d3c37c563c370dd5438908f551a1->leave($__internal_ccbf8b4d583b70b0fbee5f89de8712edc778d3c37c563c370dd5438908f551a1_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 37,  109 => 36,  98 => 6,  86 => 5,  76 => 38,  73 => 37,  71 => 36,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}

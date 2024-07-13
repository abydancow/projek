<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $function = $_POST['function'];
    $lower_bound = $_POST['lower_bound'];
    $upper_bound = $_POST['upper_bound'];
    $tolerance = $_POST['tolerance'];
    $max_iterations = $_POST['max_iterations'];

    function eval_function($function, $x)
    {
        $function = str_replace('^', '**', $function);
        $result = eval("return " . str_replace('x', "($x)", $function) . ";");
        return $result;
    }

    function bisection_method($function, $a, $b, $tol, $max_iter)
    {
        $iterations = [];
        if (eval_function($function, $a) * eval_function($function, $b) >= 0) {
            return ["error" => "Function has the same signs at the end points."];
        }

        $c = $a;
        for ($i = 0; $i < $max_iter; $i++) {
            $c = ($a + $b) / 2;
            $f_c = eval_function($function, $c);
            $iterations[] = ["iteration" => $i + 1, "a" => $a, "b" => $b, "c" => $c, "f(c)" => $f_c];

            if ($f_c == 0 || abs($b - $a) < $tol) {
                return ["root" => $c, "iterations" => $iterations];
            }

            if ($f_c * eval_function($function, $a) < 0) {
                $b = $c;
            } else {
                $a = $c;
            }
        }
        return ["error" => "Solution did not converge."];
    }

    $result = bisection_method($function, $lower_bound, $upper_bound, $tolerance, $max_iterations);

    if (isset($result["error"])) {
        echo "<div class='container'><h2>Error: " . $result["error"] . "</h2></div>";
    } else {
        echo "<div class='container'><h2>Root: " . $result["root"] . "</h2>";
        echo "<h3>Iterations:</h3>";
        echo "<table>";
        echo "<tr><th>Iteration</th><th>a</th><th>b</th><th>c</th><th>f(c)</th></tr>";
        foreach ($result["iterations"] as $iteration) {
            echo "<tr><td>" . $iteration["iteration"] . "</td><td>" . $iteration["a"] . "</td><td>" . $iteration["b"] . "</td><td>" . $iteration["c"] . "</td><td>" . $iteration["f(c)"] . "</td></tr>";
        }
        echo "</table></div>";
    }
}

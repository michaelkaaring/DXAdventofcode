defmodule Aoc16.Day02Test do
  use ExUnit.Case, async: true

  test "part 1 example code" do
    code = "ULL\nRRDDD\nLURDL\nUUUUD"
    assert Aoc16.Day02.process_text(code, false) == "1985"
  end

  test "part 2 example code" do
    code = "ULL\nRRDDD\nLURDL\nUUUUD"
    assert Aoc16.Day02.process_text(code, true) == "5DB3"
  end
end
